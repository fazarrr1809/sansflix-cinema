<?php

namespace App\Http\Controllers;

use App\Models\FoodBeverage;
use App\Models\FoodOrder;
use App\Models\FoodOrderItem;
use App\Mail\FoodReceiptMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = FoodBeverage::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_url
            ];
        }
        session()->put('cart', $cart);

        // Cek jika request via AJAX
        if ($request->ajax()) {
            return response()->json([
                'cart_count' => array_sum(array_column($cart, 'quantity'))
            ]);
        }

        return redirect()->back();
    }

   public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart');
        $id = $request->id;
        $change = $request->change;
        $itemRemoved = false;

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $change;

            if($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
                $itemRemoved = true;
            }
            session()->put('cart', $cart);
        }

        // Hitung ulang total semua item di keranjang
        $newTotal = 0;
        foreach($cart as $item) {
            $newTotal += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'status' => 'success',
            'item_removed' => $itemRemoved,
            'new_qty' => $itemRemoved ? 0 : $cart[$id]['quantity'],
            'new_subtotal' => $itemRemoved ? 0 : ($cart[$id]['price'] * $cart[$id]['quantity']),
            'new_total' => $newTotal,
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->back();

        $order = FoodOrder::create([
            'user_id' => Auth::id(),
            'total_price' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'status' => 'pending', // Berubah jadi pending
        ]);

        foreach ($cart as $id => $details) {
            FoodOrderItem::create([
                'food_order_id' => $order->id,
                'food_beverage_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // Arahkan ke halaman simulasi pembayaran
        return redirect()->route('cart.payment', $order->id);
    }

    // Tahap 2: Halaman Simulasi Pembayaran
    public function payment($id)
    {
        $order = FoodOrder::with('items.foodBeverage')->findOrFail($id);
        return view('cart.payment', compact('order'));
    }

    // Tahap 3: Proses Bayar (Mengubah status jadi Paid)
   public function payProses(Request $request, $id)
    {
    $request->validate([
        'payment_method' => 'required'
    ]);

    $order = FoodOrder::with('items.foodBeverage', 'user')->findOrFail($id);

    $order->update([
        'status' => 'paid',
        'payment_method' => $request->payment_method
    ]);

    // Tambahkan baris ini untuk mengirim email
    try {
        Mail::to($order->user->email)->send(new \App\Mail\FoodReceiptMail($order));
    } catch (\Exception $e) {
        // Jika error, log pesannya agar Anda tahu penyebabnya
        Log::error("Email Gagal: " . $e->getMessage());
    }
    session()->forget('cart'); 

    return redirect()->route('food.history')->with('success', 'Pembayaran Berhasil!');
}

    public function history()
    {
        // Mengambil pesanan makanan milik user yang sedang login
        // dengan memuat data item dan detail makanannya (eager loading)
        $orders = FoodOrder::with('items.foodBeverage')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('cart.history', compact('orders'));
    }
    public function showReceipt($id)
    {
        // Mengambil pesanan berdasarkan ID dan pastikan milik user yang login
        $order = FoodOrder::with('items.foodBeverage')
                    ->where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('cart.receipt', compact('order'));
    }

    public function downloadReceipt($id)
    {
    $order = FoodOrder::with('items.foodBeverage', 'user')
                ->where('user_id', Auth::id())
                ->findOrFail($id);

    // Menggunakan view khusus PDF agar layout tetap rapi
    $pdf = Pdf::loadView('cart.receipt_pdf', compact('order'));

    // 'download' akan langsung mengunduh, 'stream' akan membuka di tab baru
    return $pdf->download('Struk_FNB_' . $order->id . '.pdf');
    }
}