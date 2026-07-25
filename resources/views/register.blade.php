<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol - TeknoMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-800 mb-2">Aramıza Katıl</h1>
            <p class="text-gray-500">Yeni bir hesap oluştur</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
                <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Örn: Okan Çakır">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">E-posta Adresi</label>
                <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="ornek@mail.com">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                <input type="password" name="password" required minlength="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="En az 6 karakter">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Şifre (Tekrar)</label>
                <input type="password" name="password_confirmation" required minlength="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Şifrenizi doğrulayın">
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition shadow-md mt-2">
                Kayıt Ol
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Zaten hesabın var mı? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Giriş Yap</a>
        </p>
    </div>

</body>
</html>