<?php

namespace App\Http\Controllers;

use App\Models\FoodBeverage; // Pastikan ini ada
use Illuminate\Http\Request;

class FoodBeverageController extends Controller
{
    public function index(Request $request)
    {
        // Debugging: Cek apakah kategori terbaca oleh sistem
        // dd($request->category); // Hapus tanda komentar (//) ini untuk tes. 
        // Jika muncul tulisan kategori saat diklik, berarti rute aman.

        $query = FoodBeverage::query(); // Gunakan ::query() agar lebih stabil

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $menus = $query->where('is_ready', true)->get();

        return view('fnb.index', compact('menus'));
    }
}