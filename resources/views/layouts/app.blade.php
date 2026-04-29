<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Data Prestasi')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Poppins', sans-serif;
            --color-primary: #3b82f6; /* Biru muda / Blue 500 */
            --color-primary-light: #eff6ff; /* Background aktif menu */
            --color-surface: #f8fafc; /* Background utama aplikasi */
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-surface text-gray-800 antialiased overflow-hidden">

    <div id="global-loader" class="fixed inset-0 z-[9999] bg-white bg-opacity-80 backdrop-blur-sm flex-col items-center justify-center hidden">
        <div class="w-12 h-12 border-4 border-gray-200 border-t-primary rounded-full animate-spin"></div>
        <p class="mt-4 text-primary font-medium text-sm">Memuat data...</p>
    </div>

    <div class="flex h-screen w-full">
        @if(auth()->check() && auth()->user()->role == 'admin')
            @include('layouts.partials.sidebar-admin')
        @elseif(auth()->check() && auth()->user()->role == 'kepala_sekolah')
            @include('layouts.partials.sidebar-kepsek')
        @endif

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.partials.topbar')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-surface p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Tampilkan loading saat form disubmit
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById('global-loader').classList.remove('hidden');
                document.getElementById('global-loader').classList.add('flex');
            });
        });

        // SweetAlert Global Notifications
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#3b82f6'
            });
        @endif

        // Optional: Logout Handler dengan konfirmasi
        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Keluar Sistem?',
                text: "Sesi Anda akan diakhiri.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('global-loader').classList.remove('hidden');
                    document.getElementById('global-loader').classList.add('flex');
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>
</html>