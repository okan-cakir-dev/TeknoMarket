<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patron Girişi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">
    
    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-md border border-gray-700 relative overflow-hidden">
        
        <!-- Üstteki Havalı Renk Çizgisi -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-500"></div>

        <div class="text-center mb-8 mt-4">
            <h1 class="text-3xl font-bold text-white tracking-widest mb-2">GİZLİ ODA</h1>
            <p class="text-gray-400 text-sm">TeknoMarket Yönetim Paneli</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg mb-6 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif
        
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500 text-green-400 p-3 rounded-lg mb-6 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(!$adminExists)
            <!-- HİÇ HESAP YOKSA: İLK KURULUM EKRANI ÇIKAR -->
            <div class="bg-blue-900/30 border border-blue-500/50 text-blue-300 p-4 rounded-lg mb-6 text-sm text-center">
                <p class="font-bold mb-1">Hoş Geldiniz Patron!</p>
                Sistemde henüz hesap yok. Paneli yönetmek için ilk şifrenizi belirleyin.
            </div>
            
            <form action="{{ route('admin.setup') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Patron Kullanıcı Adı</label>
                    <input type="text" name="username" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Güçlü Bir Şifre</label>
                    <input type="password" name="password" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3 rounded-lg hover:from-blue-500 hover:to-blue-600 transition shadow-lg mt-4">
                    Hesabı Oluştur ve Kilitle
                </button>
            </form>
        @else
            <!-- HESAP VARSA: NORMAL GİRİŞ EKRANI ÇIKAR -->
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Kullanıcı Adı</label>
                    <input type="text" name="username" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Şifre</label>
                    <input type="password" name="password" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white outline-none focus:border-blue-500 transition">
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3 rounded-lg hover:from-blue-500 hover:to-blue-600 transition shadow-lg mt-4">
                    Sisteme Giriş Yap
                </button>
            </form>
        @endif
        
        <div class="mt-8 text-center">
            <a href="/" class="text-gray-500 hover:text-white text-sm transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Müşteri Vitrinine Dön
            </a>
        </div>
    </div>
</body>
</html>