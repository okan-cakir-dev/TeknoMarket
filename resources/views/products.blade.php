<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticaret Vitrini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 relative">

    <!-- BAŞARILI SİPARİŞ BİLDİRİMİ -->
    @if(session('success'))
        <div id="success-alert" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-4 rounded-lg shadow-2xl z-50 flex items-center gap-3 transition-opacity duration-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('success-alert').style.opacity = '0';
                setTimeout(() => document.getElementById('success-alert').remove(), 500);
            }, 4000);
        </script>
    @endif

    <!-- Üst Menü (Navbar) - ARAMA ÇUBUĞU EKLENDİ -->
    <nav class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center flex-wrap gap-4">
            <a href="/" class="text-2xl font-bold text-blue-800">TeknoMarket</a>
            
            <!-- ARAMA FORMU (YENİ EKLENDİ) -->
            <form action="/" method="GET" class="flex-grow max-w-lg mx-4 flex items-center bg-gray-100 rounded-lg overflow-hidden border border-gray-200 focus-within:border-blue-500 transition">
                <input type="text" name="arama" value="{{ request('arama') }}" placeholder="Ürün, marka veya kategori ara..." class="w-full bg-transparent px-4 py-2 outline-none text-gray-700">
                <button type="submit" class="px-4 text-gray-500 hover:text-blue-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>

            <div class="flex items-center gap-4">
                <!-- Ziyaretçi İse Bunlar Görünür -->
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-semibold transition">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition shadow">Kayıt Ol</a>
                @endguest

                <!-- Üye Girişi Yapılmışsa Bunlar Görünür -->
                @auth
                    <div class="flex items-center gap-3 border-r pr-4 mr-2 hidden md:flex">
                        <span class="font-bold text-gray-700">Merhaba, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold underline cursor-pointer">Çıkış</button>
                        </form>
                    </div>
                @endauth

                <!-- Sepet Butonu -->
                <button onclick="toggleCart()" class="flex items-center text-gray-700 bg-gray-100 px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition cursor-pointer">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Sepet ({{ count((array) session('cart')) }})
                </button>
            </div>
        </div>
    </nav>

    <!-- ANA İÇERİK -->
    <div class="max-w-7xl mx-auto px-4 pb-8 flex flex-col md:flex-row gap-8">
        
        <!-- Sol Kategori Menüsü -->
        <div class="w-full md:w-1/4">
            <div class="bg-white p-6 rounded-lg shadow-md sticky top-4">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Kategoriler</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/" class="block px-3 py-2 rounded-md transition-colors {{ !request('kategori') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            Tüm Ürünler
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="/?kategori={{ $category }}" class="block px-3 py-2 rounded-md transition-colors {{ request('kategori') == $category ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                                {{ $category }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Sağ Ürün Vitrini -->
        <div class="w-full md:w-3/4">
            <!-- BAŞLIK KISMI AKILLANDIRILDI -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">
                    @if(request('arama'))
                        "<span class="text-blue-600">{{ request('arama') }}</span>" için sonuçlar
                    @elseif(request('kategori'))
                        {{ request('kategori') }} Kategorisi
                    @else
                        Tüm Ürünler
                    @endif
                </h1>
                
                @if(request('arama') || request('kategori'))
                    <a href="/" class="text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded transition">Filtreleri Temizle</a>
                @endif
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    
                    <!-- AKILLI RESİM SEÇİCİ -->
                    <?php
                        $name = strtolower($product->name);
                        $originalName = $product->name;
                        
                        $imageUrl = 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400&h=300&fit=crop'; 
                        
                        if(str_contains($name, 'klavye') || str_contains($originalName, 'Klavye')) {
                            $imageUrl = 'https://images.unsplash.com/photo-1595225476474-87563907a212?w=400&h=300&fit=crop';
                        } else if(str_contains($name, 'mouse') || str_contains($originalName, 'Mouse')) {
                            $imageUrl = 'https://images.unsplash.com/photo-1527864551497-f14cd2892714?w=400&h=300&fit=crop';
                        } else if(str_contains($name, 'stand') || str_contains($originalName, 'Stand')) {
                            $imageUrl = 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=400&h=300&fit=crop';
                        } else if(str_contains($name, 'laptop') || str_contains($originalName, 'Laptop')) {
                            $imageUrl = 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop';
                        } else if(str_contains($name, 'kulakl') || str_contains($originalName, 'Kulakl')) {
                            $imageUrl = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop';
                        } else if(str_contains($name, 'monit') || str_contains($originalName, 'Monit')) {
                            $imageUrl = 'https://images.unsplash.com/photo-1527443154391-edc75e64f480?w=400&h=300&fit=crop';
                        }
                    ?>

                    <div class="bg-white rounded-lg shadow-md border-t-4 border-blue-500 flex flex-col justify-between hover:shadow-lg transition-shadow overflow-hidden group">
                        
                        <div class="relative overflow-hidden">
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <span class="absolute top-2 right-2 bg-white/90 text-blue-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">{{ $product->category }}</span>
                        </div>
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-semibold text-gray-700 mb-2">{{ $product->name }}</h2>
                            <p class="text-gray-500 mb-4 text-sm flex-grow">{{ $product->description }}</p>
                            
                            <div class="flex justify-between items-center mt-4 border-t pt-4">
                                <span class="text-2xl font-bold text-blue-600">{{ number_format($product->price, 2, ',', '.') }} ₺</span>
                                
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition font-medium shadow">
                                        Sepete Ekle
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-blue-50 border border-blue-200 text-blue-700 p-8 rounded-lg text-center shadow-sm">
                        <svg class="w-12 h-12 mx-auto text-blue-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="font-medium text-lg">Maalesef aradığınız kriterlere uygun ürün bulamadık.</p>
                        <p class="text-sm mt-2 text-blue-500">Farklı bir kelimeyle aramayı deneyebilirsiniz.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- SEPET ÇEKMECESİ -->
    <div id="cart-overlay" onclick="toggleCart()" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity"></div>
    
    <div id="cart-drawer" class="fixed inset-y-0 right-0 w-80 sm:w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 flex flex-col">
        <div class="p-4 border-b flex justify-between items-center bg-gray-50">
            <h2 class="text-lg font-bold text-gray-800">Alışveriş Sepetim</h2>
            <button onclick="toggleCart()" class="text-gray-500 hover:text-red-500 font-bold text-xl">&times;</button>
        </div>

        <div class="p-4 flex-1 overflow-y-auto">
            @if(session('cart') && count((array) session('cart')) > 0)
                <?php $total = 0; ?>
                @foreach(session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity']; ?>
                    <div class="flex justify-between items-center border-b pb-4 mb-4">
                        <div>
                            <h4 class="font-semibold text-gray-700">{{ $details['name'] }}</h4>
                            <span class="text-blue-600 font-bold">{{ number_format($details['price'], 2, ',', '.') }} ₺</span>
                        </div>
                        <div class="flex items-center space-x-2 border rounded-lg overflow-hidden">
                            <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-100 hover:bg-gray-200 px-3 py-1 text-gray-600 font-bold">-</button>
                            </form>
                            <span class="px-2 font-semibold">{{ $details['quantity'] }}</span>
                            <form action="{{ route('cart.increase', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-100 hover:bg-gray-200 px-3 py-1 text-gray-600 font-bold">+</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center mt-10">
                    <p class="text-gray-500">Sepetiniz şu an boş.</p>
                </div>
            @endif
        </div>

        @if(session('cart') && count((array) session('cart')) > 0)
            <div class="p-4 border-t bg-gray-50">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-bold text-gray-700">Ara Toplam:</span>
                    <span class="font-bold text-xl text-blue-600">{{ number_format($total, 2, ',', '.') }} ₺</span>
                </div>
                
                <a href="{{ route('cart.checkout.page') }}" class="block w-full bg-blue-600 text-center text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-lg">
                    Ödeme Adımına Geç
                </a>
            </div>
        @endif
    </div>

    <script>
        function toggleCart() {
            document.getElementById('cart-drawer').classList.toggle('translate-x-full');
            document.getElementById('cart-overlay').classList.toggle('hidden');
        }
        @if(session('cart_open'))
            toggleCart();
        @endif
    </script>
</body>
</html>