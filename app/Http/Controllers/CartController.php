<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Sepete İlk Kez Ürün Ekleme
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        // Sayfayı yenilemeden sağ çekmecenin açık kalması için özel bir mesaj yolluyoruz
        return redirect()->back()->with('cart_open', true);
    }

    // Sepetteki Ürün Adedini Artırma
    public function increase($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('cart_open', true);
    }

    // Sepetteki Ürün Adedini Azaltma
    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]); // 1'den düşerse sepetten tamamen sil
            }
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('cart_open', true);
    }

    // ÖDEME SAYFASINI GÖSTER
    public function checkoutPage()
    {
        // Sepet boşsa adamı ödeme sayfasına sokmayalım, ana sayfaya atalım
        if(!session()->has('cart') || count(session('cart')) == 0) {
            return redirect('/');
        }
        return view('checkout'); // checkout.blade.php dosyasını açacak
    }

    // ÖDEMEYİ ONAYLAMA VE SİPARİŞİ KAYDETME (GÜNCELLENEN KISIM)
    public function checkout(Request $request)
    {
        // Form verilerini doğrula
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $cart = session('cart', []);
        if(empty($cart)) {
            return redirect('/');
        }

        // Toplam tutarı hesapla
        $total = 0;
        foreach($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // Veritabanına Siparişi Kaydet
        \App\Models\Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total,
            'items' => json_encode($cart, JSON_UNESCAPED_UNICODE)
        ]);

        // Sepeti tamamen boşaltıyoruz
        session()->forget('cart');

        // Başarı mesajıyla birlikte ANA SAYFAYA geri gönderiyoruz
        return redirect('/')->with('success', 'Ödemeniz onaylandı! Siparişiniz başarıyla alındı, teşekkür ederiz.');
    }
}