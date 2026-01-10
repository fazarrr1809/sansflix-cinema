<?php

namespace App\Http\Controllers;

use App\Models\FoodBeverage;
use Illuminate\Http\Request; // Ini penting agar Request tidak error

class FoodBeverageController extends Controller
{
    public function index(Request $request)
    {
    // Mengambil semua menu yang tersedia
    $query = FoodBeverage::where('is_ready', true);

    // Cek apakah ada parameter 'category' di URL
    if ($request->has('category') && $request->category != 'All') {
        $query->where('category', $request->category);
    }

    $menus = $query->get();
    
    return view('fnb.index', compact('menus'));
    }

}