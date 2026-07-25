<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patron Paneli - TeknoMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans relative">

    @if(session('success'))
        <div id="success-alert" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-4 rounded-lg shadow-2xl z-50 flex items-center gap-3 transition-opacity duration-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('success-alert').style.opacity = '0';
                setTimeout(() => document.getElementById('success-alert').remove(), 500);
            }, 4000);
        </script>
    @endif

    <div class="flex h-screen overflow-hidden">
        <!-- Sol Menü -->
        <div class="w-64 bg-gray-900 text-white flex flex-col justify-between z-10">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-blue-400 mb-6">Patron Paneli</h2>
                <ul class="space-y-4">
                    <li>
                        <a href="/admin" class="flex items-center text-gray-300 hover:text-white bg-gray-800 p-3 rounded-lg transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Yönetim Paneli
                        </a>
                    </li>
                    <li>
                        <a href="/" class="flex items-center text-gray-400 hover:text-white p-3 rounded-lg transition" target="_blank">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Müşteri Vitrinine Git
                        </a>
                    </li>
                </ul>
            </div>
            <div class="p-6 border-t border-gray-700">
                <p class="text-sm text-gray-400">TeknoMarket v1.0</p>
            </div>
        </div>

        <!-- Sağ İçerik Alanı -->
        <div class="flex-1 overflow-y-auto bg-gray-50 p-8 space-y-8">
            
            <div class="flex justify-between items-center border-b pb-4">
                <h1 class="text-3xl font-bold text-gray-800">Mağaza İstatistikleri</h1>
            </div>

            <!-- YENİ EKLENEN İSTATİSTİK KARTLARI -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Ciro Kartı -->
                <div class="bg-white rounded-xl shadow-md p-6 border-b-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 font-bold mb-1 uppercase">Toplam Ciro</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalRevenue, 2, ',', '.') }} ₺</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg text-green-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Sipariş Kartı -->
                <div class="bg-white rounded-xl shadow-md p-6 border-b-4 border-blue-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 font-bold mb-1 uppercase">Siparişler</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ count($orders) }} Adet</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Ürün Kartı -->
                <div class="bg-white rounded-xl shadow-md p-6 border-b-4 border-purple-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 font-bold mb-1 uppercase">Vitrindeki Ürünler</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ count($products) }} Adet</h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg text-purple-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Müşteri Kartı -->
                <div class="bg-white rounded-xl shadow-md p-6 border-b-4 border-orange-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 font-bold mb-1 uppercase">Kayıtlı Müşteri</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $userCount }} Kişi</h3>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-lg text-orange-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SİPARİŞLER TABLOSU -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-700 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Gelen Siparişler
                    </h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                                <th class="p-4 font-semibold">Müşteri Adı</th>
                                <th class="p-4 font-semibold">Telefon</th>
                                <th class="p-4 font-semibold">Adres</th>
                                <th class="p-4 font-semibold">Sipariş İçeriği</th>
                                <th class="p-4 font-semibold text-center">Tutar</th>
                                <th class="p-4 font-semibold text-center">Sipariş Durumu</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @forelse($orders as $order)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="p-4 font-bold text-gray-900">{{ $order->name }}</td>
                                    <td class="p-4">{{ $order->phone }}</td>
                                    <td class="p-4 max-w-xs truncate" title="{{ $order->address }}">{{ $order->address }}</td>
                                    <td class="p-4">
                                        <ul class="text-xs space-y-1">
                                            @foreach(json_decode($order->items, true) as $item)
                                                <li>• <b>{{ $item['name'] }}</b> ({{ $item['quantity'] }} adet)</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="p-4 font-bold text-green-600 text-center">{{ number_format($order->total, 2, ',', '.') }} ₺</td>
                                    
                                    <!-- AKILLI DURUM SÜTUNU -->
                                    <td class="p-4 text-center">
                                        @if($order->status == 'Bekliyor')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold block mb-2">Bekliyor</span>
                                            <form action="{{ route('admin.order.status', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-2 px-2 rounded transition shadow-sm">Onayla & Hazırla</button>
                                            </form>
                                            
                                        @elseif($order->status == 'Hazırlanıyor')
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold block mb-2">Hazırlanıyor</span>
                                            <form action="{{ route('admin.order.status', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-white text-xs font-bold py-2 px-2 rounded transition shadow-sm">Kargoya Ver</button>
                                            </form>
                                            
                                        @elseif($order->status == 'Kargoya Verildi')
                                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-bold block mb-2">Kargoda 🚚</span>
                                            <form action="{{ route('admin.order.status', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white text-xs font-bold py-2 px-2 rounded transition shadow-sm">Teslim Edildi İşaretle</button>
                                            </form>
                                            
                                        @else
                                            <span class="bg-green-100 text-green-700 px-3 py-2 rounded-lg text-sm font-bold block">
                                                Teslim Edildi ✅
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500">
                                        Henüz hiç sipariş alınmadı.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ÜRÜN YÖNETİMİ VE EKLEME -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Ürün Ekleme Formu -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-green-500">
                        <h2 class="text-xl font-bold text-gray-700 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Yeni Ürün Ekle
                        </h2>
                        
                        <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ürün Adı</label>
                                <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="category" required class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none">
                                    <option value="Klavye">Klavye</option>
                                    <option value="Mouse">Mouse</option>
                                    <option value="Kulaklık">Kulaklık</option>
                                    <option value="Monitör">Monitör</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Stand">Stand</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fiyat (₺)</label>
                                <input type="number" step="0.01" name="price" required class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Açıklama</label>
                                <textarea name="description" required rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition shadow-md">
                                Vitrine Ekle
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Ürünler Listesi -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-xl font-bold text-gray-700">Vitrindeki Ürünler</h2>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                                        <th class="p-4 font-semibold">Ürün Adı</th>
                                        <th class="p-4 font-semibold text-center">Kategori</th>
                                        <th class="p-4 font-semibold text-center">Fiyat</th>
                                        <th class="p-4 font-semibold text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 text-sm">
                                    @forelse($products as $product)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="p-4 font-medium">{{ $product->name }}</td>
                                            <td class="p-4 text-center">
                                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-bold">{{ $product->category }}</span>
                                            </td>
                                            <td class="p-4 font-bold text-gray-900 text-center">{{ number_format($product->price, 2, ',', '.') }} ₺</td>
                                            <td class="p-4 text-center">
                                                <div class="flex justify-center gap-2">
                                                    <button onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})" class="bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white px-3 py-1 rounded transition font-medium text-xs">
                                                        DÜZENLE
                                                    </button>
                                                    
                                                    <form action="{{ route('admin.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">
                                                        @csrf
                                                        <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 py-1 rounded transition font-medium text-xs">
                                                            SİL
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="p-8 text-center text-gray-500">
                                                Henüz hiç ürün eklemediniz.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- DÜZENLEME MODALI -->
    <div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center transition-opacity">
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md transform transition-all">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Ürünü Düzenle</h2>
            <form id="edit-form" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ürün Adı</label>
                    <input type="text" id="edit-name" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fiyat (₺)</label>
                    <input type="number" step="0.01" id="edit-price" name="price" required class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none">
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="closeEditModal()" class="w-1/2 bg-gray-200 text-gray-700 font-bold py-2 rounded-lg">İptal</button>
                    <button type="submit" class="w-1/2 bg-blue-600 text-white font-bold py-2 rounded-lg shadow">Kaydet</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, price) {
            document.getElementById('edit-form').action = '/admin/guncelle/' + id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-price').value = price;
            document.getElementById('edit-modal').classList.remove('hidden');
        }
        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
        }
    </script>
</body>
</html>