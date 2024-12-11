<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi untuk placeholder */
        .form-control:focus::placeholder {
            color: transparent;
            transition: color 0.3s;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-300 via-green-400 to-green-500 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-xl">
        <!-- Header -->
        <div class="bg-green-600 text-white text-center py-5 rounded-t-lg">
            <h1 class="text-2xl font-bold">Klinik Pratama Firdaus</h1>
            <p class="text-sm mt-1">Selamat datang, silakan login</p>
        </div>

        <!-- Form -->
        <div class="p-6">
            <form action="{{ route('login-proses') }}" method="POST" class="space-y-6">
                <!-- Email -->
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 relative">
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda"
                            class="form-control block w-full px-4 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500"
                            required />
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                </div>
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1 relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda"
                            class="form-control block w-full px-4 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500"
                            required />
                        <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-400"
                            onclick="togglePasswordVisibility()">
                            <i id="eye-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                @error('password')
                    <small>{{ $message }}</small>
                @enderror

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" class="form-checkbox text-green-600 border-gray-300 rounded" />
                        <span class="ml-2">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-300 font-medium">
                    Login
                </button>
            </form>

            <!-- Footer -->
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
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    @if ($message = Session::get('succes'))
        <script>
            Swal.fire("{{ $message }}");
        </script>
        @endif @if ($message = Session::get('error'))
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "{{ $message }}",
                });
            </script>
        @endif
</body>

</html>
