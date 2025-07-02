<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 min-h-screen bg-white border-r border-gray-200">
        <div class="flex items-center justify-center h-16 border-b border-gray-200">
            <span class="text-xl font-bold text-indigo-600">Karyawan Pay</span>
        </div>

        <div class="p-4 text-gray-500 text-sm font-semibold uppercase">Menu</div>

        <nav class="px-2 space-y-2">
            <a href="{{ route('Director.showReports') }}"
                class="flex items-center px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <span class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                </span>Laporan Pengajuan Gaji
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Top Navbar -->
        <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200">
            <!-- Left side: Toggle Sidebar -->
            <div>
                <button id="toggleSidebar" class="text-gray-500 hover:text-gray-700 text-xl">
                    ☰
                </button>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative inline-block text-left">
                <!-- Trigger -->
                <button id="profileButton"
                    class="flex items-center gap-2 px-3 py-1 rounded cursor-pointer hover:bg-gray-100 focus:outline-none">
                    <span class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25L12 15.75L4.5 8.25" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div id="dropdownMenu"
                    class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-gray-900 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- JavaScript -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const profileButton = document.getElementById('profileButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        profileButton.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!dropdownMenu.contains(e.target) && !profileButton.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });


        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const profileButton = document.getElementById('profileButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        profileButton.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!dropdownMenu.contains(e.target) && !profileButton.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            customClass: {
                popup: 'swalnotif'
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        @if (session('error'))
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        @endif

        @if (session('success'))
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        @endif
    </script>
</body>

</html>
