<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('lte/plugins/favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .login-animation {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-green-400 via-emerald-400 to-teal-400 min-h-screen flex items-center justify-center p-4">
    <div class="login-animation w-full max-w-md glass-effect rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white text-center py-6 px-4">
            <img src="{{ asset('lte/dist/img/logo_klinik.jpg') }}" alt="Logo"
                class="mx-auto h-20 w-20 rounded-full border-4 border-white mb-3">
            <h1 class="text-3xl font-bold">Klinik Pratama Firdaus</h1>
            <p class="text-sm mt-2 opacity-90">Selamat datang, silakan login untuk melanjutkan</p>
        </div>

        <!-- Form -->
        <div class="p-8">
            <form action="{{ route('login-proses') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold text-gray-600">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email"
                            class="form-control w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                            placeholder="Masukkan email Anda" required />
                        <i class="fas fa-envelope absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    @error('email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-sm font-semibold text-gray-600">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="form-control w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                            placeholder="Masukkan password Anda" required />
                        <button type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                            onclick="togglePasswordVisibility()">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox"
                            class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 rounded-lg hover:opacity-90 transition duration-300 font-medium text-sm uppercase tracking-wider">
                    Login
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ $message }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ $message }}",
                confirmButtonColor: '#10B981'
            });
        </script>
    @endif
</body>

</html>
