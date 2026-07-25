<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Güvenli Ödeme - TeknoMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-800">TeknoMarket</a>
            <span class="text-gray-500 font-medium">🔒 Güvenli Ödeme Noktası</span>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 pb-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Siparişi Tamamla</h1>

        <form action="{{ route('cart.checkout') }}" method="POST" class="bg-white rounded-xl shadow-lg flex flex-col md:flex-row overflow-hidden">
            @csrf
            
            <!-- SOL TARAF: ADRES BİLGİLERİ -->
            <div class="p-8 w-full md:w-1/2 border-b md:border-b-0 md:border-r border-gray-200">
                <h2 class="text-xl font-bold text-gray-700 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Teslimat Adresi
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
                        <!-- name="name" EKLENDİ -->
                        <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="Örn: Okan Çakır">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telefon</label>
                        <!-- name="phone" EKLENDİ -->
                        <input type="text" id="phone" name="phone" required maxlength="14" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="0555 555 55 55">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Açık Adres</label>
                        <!-- name="address" EKLENDİ -->
                        <textarea required name="address" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="Mahalle, Sokak, No..."></textarea>
                    </div>
                </div>
            </div>

            <!-- SAĞ TARAF: KART BİLGİLERİ -->
            <div class="p-8 w-full md:w-1/2 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-700 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Kredi Kartı
                </h2>

                <!-- CANLI GÜNCELLENEN KART GÖRSELİ -->
                <div class="w-full h-40 bg-gradient-to-r from-blue-700 to-blue-900 rounded-xl mb-6 shadow-md p-5 text-white flex flex-col justify-between transition-all duration-300 transform hover:scale-105">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-8 bg-yellow-400 rounded opacity-80"></div>
                        <span class="font-bold italic text-lg">VISA</span>
                    </div>
                    <div>
                        <p id="card-visual-number" class="font-mono tracking-widest mb-1 text-sm opacity-80">**** **** **** ****</p>
                        <div class="flex justify-between text-xs">
                            <span id="card-visual-name" class="uppercase">KART SAHİBİ</span>
                            <span id="card-visual-expiry">AA/YY</span>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kart Üzerindeki İsim</label>
                        <input type="text" id="cardName" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="AD SOYAD">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kart Numarası</label>
                        <input type="text" id="cardNumber" required maxlength="19" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="1111 2222 3333 4444">
                    </div>
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Son Kul. (AA/YY)</label>
                            <input type="text" id="cardExpiry" required maxlength="5" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="12/28">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                            <input type="text" id="cardCvv" required maxlength="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="***">
                        </div>
                    </div>
                </div>

                @php 
                    $total = 0; 
                    if(session('cart')) {
                        foreach(session('cart') as $details) {
                            $total += $details['price'] * $details['quantity'];
                        }
                    }
                @endphp

                <button type="submit" class="w-full bg-green-600 text-white font-bold py-4 rounded-lg mt-8 hover:bg-green-700 transition shadow-lg text-lg flex justify-center items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    {{ number_format($total, 2, ',', '.') }} ₺ Öde ve Bitir
                </button>
            </div>
        </form>
    </div>

    <!-- OTOMATİK FORMATLAMA VE CANLI KART SİHRİ -->
    <script>
        // 1. Telefon Numarası Formatlayıcı (0555 555 55 55)
        document.getElementById('phone').addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, '').substring(0, 11); // Sadece 11 rakam kabul et
            let formatted = '';
            for(let i = 0; i < val.length; i++) {
                if(i === 4 || i === 7 || i === 9) formatted += ' '; // Boşlukları otomatik koy
                formatted += val[i];
            }
            e.target.value = formatted;
        });

        // 2. Kart Numarası Formatlayıcı ve Görsel Güncelleyici
        document.getElementById('cardNumber').addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, '').substring(0, 16); // Sadece 16 rakam
            let formatted = val.match(/.{1,4}/g)?.join(' ') || ''; // Her 4 rakamda bir boşluk
            e.target.value = formatted;
            document.getElementById('card-visual-number').innerText = formatted || '**** **** **** ****';
        });

        // 3. Kart İsim Güncelleyici
        document.getElementById('cardName').addEventListener('input', function (e) {
            document.getElementById('card-visual-name').innerText = e.target.value.trim().toUpperCase() || 'KART SAHİBİ';
        });

        // 4. Son Kullanma Tarihi Formatlayıcı (AA/YY)
        document.getElementById('cardExpiry').addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, '').substring(0, 4); // Sadece 4 rakam
            let formatted = val;
            if (val.length >= 3) {
                formatted = val.substring(0, 2) + '/' + val.substring(2, 4); // Araya Eğik Çizgi
            }
            e.target.value = formatted;
            document.getElementById('card-visual-expiry').innerText = formatted || 'AA/YY';
        });

        // 5. CVV Sadece Rakam Kontrolü
        document.getElementById('cardCvv').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 3);
        });
    </script>
</body>
</html>