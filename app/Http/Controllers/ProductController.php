<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Temel ürün sorgusunu başlat
        $query = Product::query();

        // 1. Kategoriye göre filtreleme (Zaten vardı)
        if ($request->has('kategori')) {
            $query->where('category', $request->kategori);
        }

        // 2. Arama motoruna göre filtreleme (YENİ EKLENDİ)
        if ($request->has('arama') && $request->arama != '') {
            $aranan = $request->arama;
            // Hem ürün adında hem de açıklamasında bu kelimeyi ara
            $query->where(function($q) use ($aranan) {
                $q->where('name', 'like', '%' . $aranan . '%')
                  ->orWhere('description', 'like', '%' . $aranan . '%');
            });
        }

        // Ürünleri getir
        $products = $query->get();

        // Sol menü için kategorileri dinamik olarak al
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('products', compact('products', 'categories'));
    }
}