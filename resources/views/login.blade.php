<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Web Penggajian Karyawan</title>

    <!-- Font Awesome untuk ikon mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css " />

</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4 py-12 font-inter">
    <!-- Card Login -->
    <div
        class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 border border-gray-200 
              transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

        <!-- Logo & Judul -->
        <div class="text-center mb-8">
            <div class="flex justify-center">
                <div class="bg-indigo-600 p-3 rounded-full shadow-md flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9h3m-3 3h3m-3 3h3M6 9a3 3 0 1 1 0-6 3 3 0 0 1 0 6ZM6 21a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-2xl font-bold tracking-tight text-gray-900">Masuk ke Akun Anda</h2>
            <p class="mt-2 text-sm text-gray-500">Masukkan email dan password</p>
        </div>

        <!-- Form Login -->
        <form class="mt-6 space-y-5" action="{{ route('UserLogin') }}" method="POST">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                    class="w-full rounded-md border border-gray-300 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 py-2 px-3 transition duration-200 ease-in-out"
                    placeholder="you@gmail.com" />
            </div>

            <!-- Password dengan Ikon Mata -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">Forgot password?</a>
                </div>
                <div class="relative mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="w-full rounded-md border border-gray-300 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 py-2 px-3 pr-10 transition duration-200 ease-in-out"
                        placeholder="••••••••" />

                    <!-- Ikon mata untuk toggle -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <i id="togglePasswordIcon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm hover:shadow transition duration-200 ease-in-out focus:outline-none">
                    Login
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-800">Daftar sekarang</a>
            </p>
        </div>
    </div>


    <!-- Script Toggle Password -->
    <script>
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
    </script>
</body>

</html>
