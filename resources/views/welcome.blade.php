<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteApp - Pilih Aksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
            }

            50% {
                box-shadow: 0 0 30px rgba(139, 92, 246, 0.6);
            }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glassmorphism {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .modal-backdrop {
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <!-- Decorative floating elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full float-animation"></div>
        <div class="absolute top-1/4 right-16 w-12 h-12 bg-white bg-opacity-10 rounded-full float-animation"
            style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-white bg-opacity-10 rounded-full float-animation"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/3 right-10 w-8 h-8 bg-white bg-opacity-10 rounded-full float-animation"
            style="animation-delay: 0.5s;"></div>
    </div>

    <div class="glassmorphism rounded-3xl p-8 max-w-lg w-full text-center shadow-2xl">
        <!-- Logo/Icon -->
        <div class="mb-8">
            <div
                class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full mx-auto flex items-center justify-center mb-4 pulse-glow">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">VoteApp</h1>
            <p class="text-white text-opacity-80">Pilih aksi yang ingin Anda lakukan</p>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <!-- Voting Button -->
            <button onclick="window.location='{{ route('vote.index') }}'"
                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-2xl shadow-lg transform hover:scale-105 transition-all duration-300 hover:shadow-xl group">
                <div class="flex items-center justify-center space-x-3">
                    <div
                        class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center group-hover:bg-opacity-30 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 011 1v2a1 1 0 01-1 1h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 01-1-1V5a1 1 0 011-1h4z">
                            </path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h3 class="text-lg font-bold">Voting</h3>
                        <p class="text-sm text-white text-opacity-80">Berikan suara Anda</p>
                    </div>
                </div>
            </button>

            <!-- Monitor Button -->
            <button onclick="openPasswordModal()"
                class="w-full bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white font-semibold py-4 px-8 rounded-2xl shadow-lg transform hover:scale-105 transition-all duration-300 hover:shadow-xl group">
                <div class="flex items-center justify-center space-x-3">
                    <div
                        class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center group-hover:bg-opacity-30 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <h3 class="text-lg font-bold">Monitor</h3>
                        <p class="text-sm text-white text-opacity-80">Lihat hasil real-time</p>
                    </div>
                </div>
            </button>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 pt-6 border-t border-white border-opacity-20">
            <p class="text-white text-opacity-60 text-sm">
                🚀 Sistem voting digital yang aman dan transparan
            </p>
        </div>
    </div>

    <!-- Password Modal -->
    <div id="passwordModal" class="fixed inset-0 modal-backdrop flex items-center justify-center p-4 hidden z-50">
        <div class="glassmorphism rounded-2xl p-6 max-w-md w-full shadow-2xl transform transition-all duration-300">
            <div class="text-center mb-6">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-full mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Akses Monitor</h3>
                <p class="text-white text-opacity-80 text-sm">Masukkan password untuk mengakses halaman monitor</p>
            </div>

            <form id="passwordForm" class="space-y-4">
                <div>
                    <input type="password" id="passwordInput" placeholder="Masukkan password..."
                        class="w-full px-4 py-3 bg-white bg-opacity-20 border border-white border-opacity-30 rounded-xl text-white placeholder-white placeholder-opacity-60 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all duration-300">
                </div>
                <div id="errorMessage" class="text-red-300 text-sm hidden">Password salah! Silakan coba lagi.</div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closePasswordModal()"
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
            document.getElementById('passwordInput').focus();
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
            document.getElementById('passwordInput').value = '';
            document.getElementById('errorMessage').classList.add('hidden');
        }

        document.getElementById('passwordForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const password = document.getElementById('passwordInput').value;
            const correctPassword = 'admin123'; // Ganti dengan password yang diinginkan

            if (password === correctPassword) {
                // Redirect ke halaman monitor (ganti dengan route yang sesuai)
                window.location.href = '/monitor'; // atau route yang sesuai
            } else {
                document.getElementById('errorMessage').classList.remove('hidden');
                document.getElementById('passwordInput').value = '';
                document.getElementById('passwordInput').focus();
            }
        });

        // Close modal when clicking outside
        document.getElementById('passwordModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closePasswordModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closePasswordModal();
            }
        });
    </script>

</body>

</html>