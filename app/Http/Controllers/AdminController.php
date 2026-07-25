<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    // 1. Admin Panelini Göster ve Ürünleri Listele
  public function index()
    {
        $products = \App\Models\Product::orderBy('created_at', 'desc')->get();
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->get();
        
        // İSTATİSTİKLER (YENİ EKLENDİ)
        $totalRevenue = \App\Models\Order::sum('total'); // Tüm siparişlerin toplam tutarı
        $userCount = \App\Models\User::count(); // Kayıtlı üye sayısı

        return view('admin', compact('products', 'orders', 'totalRevenue', 'userCount'));
    }

    // 2. Yeni Ürün Ekleme İşlemi
    public function store(Request $request)
    {
        // Formdan gelen verileri kontrol et
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        // Veritabanına yeni ürünü kaydet
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->image = 'default.jpg'; // Resimleri zaten ön yüzde isme göre akıllı atıyoruz
        $product->save();

        return redirect()->back()->with('success', 'Harika! Yeni ürün başarıyla vitrine eklendi.');
    }

    // 3. Ürün Silme İşlemi
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Ürün başarıyla silindi ve vitrinden kaldırıldı.');
    }

    // 4. Ürün Güncelleme İşlemi
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return redirect()->back()->with('success', 'Ürün bilgileri başarıyla güncellendi!');
    }

    // --- PATRON GİRİŞ VE KURULUM SİSTEMİ ---
    
    public function loginPage() 
    {
        // Sistemde hiç admin var mı kontrol et
        $adminExists = \App\Models\Admin::count() > 0;
        return view('admin-login', compact('adminExists'));
    }

    public function setupAdmin(Request $request) 
    {
        $admin = new \App\Models\Admin();
        $admin->username = $request->username;
        $admin->password = \Hash::make($request->password);
        $admin->save();
        
        return redirect('/admin/giris')->with('success', 'Patron hesabı oluşturuldu! Lütfen giriş yapın.');
    }

    public function loginAdmin(Request $request) 
    {
        $admin = \App\Models\Admin::where('username', $request->username)->first();
        
        if($admin && \Hash::check($request->password, $admin->password)) {
            // Şifre doğruysa session ile giriş yap
            session(['admin_logged_in' => true]);
            return redirect('/admin');
        }
        
        return redirect()->back()->withErrors(['Hatalı kullanıcı adı veya şifre!']);
    }

    public function logoutAdmin() 
    {
        session()->forget('admin_logged_in');
        return redirect('/admin/giris');
    }

    // --- SİPARİŞ DURUMUNU İLERLETME MANTIĞI ---
    public function updateOrderStatus($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        // Sistemin akıllı sıralaması
        if ($order->status == 'Bekliyor') {
            $order->status = 'Hazırlanıyor';
        } elseif ($order->status == 'Hazırlanıyor') {
            $order->status = 'Kargoya Verildi';
        } elseif ($order->status == 'Kargoya Verildi') {
            $order->status = 'Teslim Edildi';
        }

        $order->save();

        return redirect()->back()->with('success', 'Harika! Sipariş bir sonraki aşamaya geçirildi.');
    }
}