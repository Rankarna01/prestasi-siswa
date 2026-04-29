<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Data Prestasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Poppins', sans-serif;
            --color-primary: #3b82f6;
            --color-surface: #f8fafc;
        }
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-surface text-gray-800 antialiased flex items-center justify-center min-h-screen relative">

    <div id="loading-screen" class="fixed inset-0 z-[9999] bg-white bg-opacity-80 backdrop-blur-sm flex-col items-center justify-center hidden">
        <div class="w-12 h-12 border-4 border-gray-200 border-t-primary rounded-full animate-spin"></div>
        <p class="mt-4 text-primary font-medium">Memproses data...</p>
    </div>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 relative z-10 border border-gray-100">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-primary mb-4">
                <i class="fa-solid fa-medal text-3xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
            <p class="text-sm text-gray-500 mt-1">Sistem Manajemen Data Prestasi Siswa</p>
        </div>

        <form action="{{ route('login.process') }}" method="POST" id="main-form">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-regular fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-sm @error('email') border-red-500 @enderror" placeholder="admin@sekolah.com" required value="{{ old('email') }}">
                </div>
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="password" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-sm @error('password') border-red-500 @enderror" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-blue-600 text-white font-medium py-2.5 rounded-lg transition-colors shadow-sm focus:ring-4 focus:ring-blue-100">
                Masuk ke Sistem
            </button>
        </form>
    </div>

    <script>
        // Form Submit Loading
        document.getElementById('main-form').addEventListener('submit', function() {
            document.getElementById('loading-screen').classList.remove('hidden');
            document.getElementById('loading-screen').classList.add('flex');
        });

        // SweetAlert Handling
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#3b82f6'
            });
        @endif

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3b82f6',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</body>
</html>