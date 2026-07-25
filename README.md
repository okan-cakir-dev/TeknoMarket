# 🛒 TeknoMarket - Full-Stack Laravel E-Ticaret Platformu

Modern, hızlı ve tam donanımlı bir e-ticaret altyapısı. Laravel ve Tailwind CSS kullanılarak sıfırdan geliştirilmiş bu proje; hem müşteriler için pürüzsüz bir alışveriş deneyimi hem de yöneticiler için kapsamlı bir mağaza kontrolü sunar.

## ✨ Öne Çıkan Özellikler

### 🛍️ Müşteri Vitrini (Front-End)
* **Dinamik Ürün Vitrini:** Ürünlerin kategorilere göre anlık filtrelenmesi.
* **Akıllı Arama Motoru:** Veritabanında ürün adı ve açıklamasına göre saniyeler içinde sonuç veren arama algoritması.
* **Modern Sepet Sistemi:** Sayfa yenilemeden çalışan, sağdan açılır şık sepet (Off-canvas cart).
* **Güvenli Ödeme Ekranı (Checkout):** Kredi kartı numarası, son kullanma tarihi ve telefon numarası için otomatik formatlama yapan canlı UI/UX animasyonlu ödeme adımı.

### 👑 Patron Paneli (Admin Dashboard)
* **İzole Güvenlik Duvarı (Middleware):** Sadece yetkili patron hesabının erişebildiği, özel şifreleme ile korunan Dark Mode giriş ekranı.
* **Canlı İstatistikler:** Toplam ciro, sipariş adedi, ürün ve kayıtlı müşteri sayısını gösteren analiz kartları.
* **CRUD İşlemleri:** Modal (Açılır pencere) destekli ürün ekleme, anında silme ve fiyat/isim güncelleme sistemi.
* **Sipariş State-Machine (Durum Motoru):** Gelen siparişleri "Bekliyor -> Hazırlanıyor -> Kargoya Verildi -> Teslim Edildi" akışında yöneten akıllı buton entegrasyonu.

## 💻 Kullanılan Teknolojiler
* **Back-End:** PHP 8, Laravel 11
* **Front-End:** Blade Templating, Tailwind CSS, JavaScript (Vanilla)
* **Veritabanı:** MySQL (Eloquent ORM)

## 🚀 Kurulum (Local ortamda çalıştırmak için)

1. Projeyi klonlayın:
   ```bash
   git clone [https://github.com/okan-cakir-dev/teknomarket.git](https://github.com/okan-cakir-dev/teknomarket.git)