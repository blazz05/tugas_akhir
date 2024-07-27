<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto mt-5">
        <div class="bg-white p-5 rounded-lg shadow-lg text-center">
            <h1 class="text-2xl font-bold mb-4">Terima Kasih Telah Mendaftar!</h1>
            <p class="text-gray-700 mb-4">Akun Anda sedang menunggu konfirmasi dari admin. Anda akan menerima email pemberitahuan setelah akun Anda dikonfirmasi.</p>
            <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
