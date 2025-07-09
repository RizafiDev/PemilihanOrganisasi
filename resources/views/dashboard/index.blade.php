<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilihan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
        }

        .glass-effect {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-backdrop {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .nav-text {
            color: #475569;
        }

        .nav-text:hover {
            color: #1e293b;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .section-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .text-primary {
            color: #334155;
        }

        .text-secondary {
            color: #64748b;
        }
    </style>
</head>

<body class="gradient-bg min-h-screen font-sans">
    <!-- Navigation -->
    <nav class="glass-effect shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-vote-yea text-blue-600 text-xl mr-3"></i>
                    <span class="nav-text text-lg font-bold">Dashboard Pemilihan</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="nav-text hover:text-blue-600 transition-colors cursor-pointer">
                        <i class="fas fa-user-circle mr-2"></i>
                        Admin
                    </div>
                    <div class="nav-text hover:text-blue-600 transition-colors cursor-pointer">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 ">
        <div class="main-card rounded-3xl p-8 shadow-xl">
            <!-- Header -->
            <div class="text-center mb-12 fade-in">
                <h1 class="text-4xl font-bold text-primary mb-4">
                    <i class="fas fa-tachometer-alt mr-4 text-blue-600"></i>
                    Dashboard Pemilihan
                </h1>
                <p class="text-secondary text-lg">Kelola sistem pemilihan dengan aman dan terpercaya</p>
            </div>

            <!-- Status & Info -->
            <div class="grid grid-cols-1  gap-6 mb-8">
                <div class="section-card rounded-2xl p-6 fade-in">
                    <div class="text-center">
                        <i class="fas fa-clock text-3xl mb-4 text-green-500"></i>
                        <h3 class="text-lg font-bold mb-3 text-primary">Status Pemilihan</h3>
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-800 font-medium border border-green-200">
                            <i class="fas fa-circle text-green-500 mr-2 text-xs"></i>
                            SEDANG BERLANGSUNG
                        </span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- Total Suara -->
                <div
                    class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl p-6 text-blue-800 card-hover fade-in">
                    <div class="text-center">
                        <i class="fas fa-poll text-5xl mb-4 text-blue-600"></i>
                        <h2 class="text-3xl font-bold mb-2">{{ $totalSuara ?? 0 }}</h2>
                        <h3 class="text-xl mb-2">Total Suara Masuk</h3>
                        <p class="text-blue-600">Suara yang telah diberikan</p>
                    </div>
                </div>

                <!-- Total Kandidat -->
                <div
                    class="bg-gradient-to-br from-emerald-50 to-emerald-100 border border-emerald-200 rounded-2xl p-6 text-emerald-800 card-hover fade-in">
                    <div class="text-center">
                        <i class="fas fa-users text-5xl mb-4 text-emerald-600"></i>
                        <h2 class="text-3xl font-bold mb-2">
                            {{ $totalKandidat ?? 0 }}
                        </h2>
                        <h3 class="text-xl mb-2">Total Kandidat</h3>
                        <p class="text-emerald-600">Kandidat terdaftar</p>
                    </div>
                </div>

                <!-- Tingkat Partisipasi -->
                <div
                    class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-2xl p-6 text-purple-800 card-hover fade-in md:col-span-2 lg:col-span-1">
                    <div class="text-center">
                        <i class="fas fa-chart-pie text-5xl mb-4 text-purple-600"></i>
                        <h2 class="text-3xl font-bold mb-2">{{ number_format($partisipasi ?? 0, 1) }}%</h2>
                        <h3 class="text-xl mb-2">Tingkat Partisipasi</h3>
                        <p class="text-purple-600">Dari total pemilih</p>
                    </div>
                </div>
            </div>



            <!-- Action Section -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-primary mb-6 fade-in">
                    <i class="fas fa-cogs mr-3 text-blue-600"></i>
                    Aksi Cepat
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tambah Kandidat -->
                    <div class="section-card rounded-2xl p-6 card-hover fade-in">
                        <div class="text-center">
                            <i class="fas fa-user-plus text-4xl mb-4 text-blue-500"></i>
                            <h3 class="text-xl font-bold mb-3 text-primary">Tambah Kandidat</h3>
                            <p class="text-secondary mb-6">Daftarkan kandidat baru untuk pemilihan</p>
                            <button onclick="openModalTambah()"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Kandidat
                            </button>
                        </div>
                    </div>

                    <!-- Kelola Kandidat -->
                    <div class="section-card rounded-2xl p-6 card-hover fade-in">
                        <div class="text-center">
                            <i class="fas fa-users-cog text-4xl mb-4 text-emerald-500"></i>
                            <h3 class="text-xl font-bold mb-3 text-primary">Kelola Kandidat</h3>
                            <p class="text-secondary mb-6">Edit atau hapus data kandidat yang ada</p>
                            <button onclick="openModalKelola()"
                                class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-edit mr-2"></i>
                                Kelola Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Important Notice -->
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 fade-in">
                <div class="flex items-start">
                    <i class="fas fa-shield-alt text-amber-600 text-2xl mr-4 mt-1"></i>
                    <div class="text-amber-800">
                        <h3 class="font-bold mb-2">Kerahasiaan Terjamin</h3>
                        <p class="text-sm">Hasil suara bersifat rahasia dan hanya akan diumumkan setelah periode
                            pemilihan berakhir secara resmi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kelola Kandidat -->
    <div id="kelolaKandidatModal" class="fixed inset-0 z-50 hidden">
        <div class="modal-backdrop fixed inset-0" onclick="closeKelolaModal()"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-2xl max-w-6xl w-full max-h-[90vh] transform transition-all duration-300 scale-95"
                id="kelolaModalContent">
                <!-- Modal Header -->
                <div class="bg-emerald-500 text-white p-6 rounded-t-3xl">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold">
                            <i class="fas fa-users-cog mr-3"></i>
                            Kelola Data Kandidat
                        </h2>
                        <button onclick="closeKelolaModal()" class="text-white hover:text-gray-200 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <!-- Search & Filter -->
                    <div class="flex w-full gap-4 mb-6">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchKandidat" placeholder="Cari nama kandidat..."
                                    class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300">
                                <i
                                    class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                    </div>

<!-- Table Kandidat -->
                    <div class="bg-gray-50 rounded-2xl overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-emerald-100 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Foto</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Jenis Kelamin</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Jabatan</th>
                                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <table class="w-full">
                                <tbody id="kandidatTableBody">
                                    @foreach ($kandidats as $kandidat)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition-colors">
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kandidat->id }}</td>
                                            <td class="px-6 py-4">
                                                <img src="{{ asset('storage/' . $kandidat->foto) }}" alt="{{ $kandidat->nama }}"
                                                    class="w-16 h-16 object-cover rounded-lg">
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{$kandidat->nama}}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kandidat->jenis_kelamin}}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{$kandidat->jabatan_terpilih ?? '-'}}</td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <button onclick="editKandidat({{ $kandidat->id }})"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105"
                                                        title="Edit Kandidat">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button
                                                        onclick="deleteKandidat({{ $kandidat->id }}, '{{ $kandidat->nama }}')"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105"
                                                        title="Hapus Kandidat">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Empty State -->
                    <div id="emptyState" class="hidden text-center py-12">
                        <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-500 mb-2">Belum Ada Kandidat</h3>
                        <p class="text-gray-400">Tambahkan kandidat baru untuk memulai pemilihan</p>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div
                    class="flex justify-between items-center px-6 py-4 bg-gray-50 rounded-b-3xl border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2"></i>
                        Hati-hati saat menghapus data kandidat
                    </div>
                    <button onclick="closeKelolaModal()"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all duration-300">
                        <i class="fas fa-times mr-2"></i>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kandidat -->
    <div id="editKandidatModal" class="fixed inset-0 z-50 hidden">
        <div class="modal-backdrop fixed inset-0" onclick="closeEditModal()"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95"
                id="editModalContent">
                <!-- Modal Header -->
                <div class="bg-emerald-500 text-white p-6 rounded-t-3xl">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold">
                            <i class="fas fa-user-edit mr-3"></i>
                            Edit Kandidat
                        </h2>
                        <button onclick="closeEditModal()" class="text-white hover:text-gray-200 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form id="editKandidatForm" action="" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label for="editNama" class="block text-sm font-semibold text-gray-700 mb-2">Nama
                                Kandidat</label>
                            <input type="text" id="editNama" name="nama" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan nama lengkap">
                        </div>

                        <div>
                            <label for="editJenisKelamin" class="block text-sm font-semibold text-gray-700 mb-2">Jenis
                                Kelamin</label>
                            <select id="editJenisKelamin" name="jenis_kelamin" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label for="editJabatanTerpilih"
                                class="block text-sm font-semibold text-gray-700 mb-2">Jabatan yang Dipilih</label>
                            <input type="text" id="editJabatanTerpilih" name="jabatan_terpilih"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan jabatan (opsional)">
                        </div>

                        <div>
                            <label for="editFoto" class="block text-sm font-semibold text-gray-700 mb-2">Foto
                                Kandidat</label>
                            <input type="file" id="editFoto" name="foto" accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika
                                tidak ingin mengubah foto.</p>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeEditModal()"
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all duration-300">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-save mr-2"></i>
                            Update Kandidat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kandidat -->
    <div id="addKandidatModal" class="fixed inset-0 z-50 hidden">
        <div class="modal-backdrop fixed inset-0" onclick="closeModal()"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95"
                id="modalContent">
                <!-- Modal Header -->
                <div class="bg-blue-500 text-white p-6 rounded-t-3xl">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold">
                            <i class="fas fa-user-plus mr-3"></i>
                            Tambah Kandidat Baru
                        </h2>
                        <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form action="{{ route('kandidat.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama
                                Kandidat</label>
                            <input type="text" id="nama" name="nama" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">Jenis
                                Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="jabatan_terpilih" class="block text-sm font-semibold text-gray-700 mb-2">Jabatan
                                yang Dipilih</label>
                            <input type="text" id="jabatan_terpilih" name="jabatan_terpilih"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                placeholder="Masukkan jabatan (opsional)">
                        </div>
                        <div>
                            <label for="foto" class="block text-sm font-semibold text-gray-700 mb-2">Foto
                                Kandidat</label>
                            <input type="file" id="foto" name="foto" accept="image/*" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, JPEG. Maksimal 2MB.</p>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="closeModal()"
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all duration-300">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-500  hover:bg-blue-600  text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Kandidat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fade in animation
        document.addEventListener('DOMContentLoaded', function () {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Modal functions
        function openModalTambah() {
            const modal = document.getElementById('addKandidatModal');
            const modalContent = document.getElementById('modalContent');
            
            // Lock body scroll
            document.body.style.overflow = 'hidden';
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('addKandidatModal');
            const modalContent = document.getElementById('modalContent');
            
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                // Unlock body scroll
                document.body.style.overflow = '';
            }, 300);
        }

        // Modal Kelola Kandidat functions
        function openModalKelola() {
            const modal = document.getElementById('kelolaKandidatModal');
            const modalContent = document.getElementById('kelolaModalContent');
            
            // Lock body scroll
            document.body.style.overflow = 'hidden';
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
            
            loadKandidatData();
        }

        function closeKelolaModal() {
            const modal = document.getElementById('kelolaKandidatModal');
            const modalContent = document.getElementById('kelolaModalContent');
            
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                // Unlock body scroll
                document.body.style.overflow = '';
            }, 300);
        }

        // Modal Edit Kandidat functions
        function openEditModal() {
            const modal = document.getElementById('editKandidatModal');
            const modalContent = document.getElementById('editModalContent');
            
            // Lock body scroll
            document.body.style.overflow = 'hidden';
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('editKandidatModal');
            const modalContent = document.getElementById('editModalContent');
            
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                // Unlock body scroll
                document.body.style.overflow = '';
            }, 300);
        }

        // Placeholder functions untuk logic yang akan Anda implementasi
        function loadKandidatData() {
            // Logic untuk load data kandidat dari backend
            console.log('Loading kandidat data...');
        }

        function editKandidat(id) {
            // Cari data kandidat berdasarkan ID dari data yang sudah ada di halaman
            const kandidatData = @json($kandidats);
            const kandidat = kandidatData.find(k => k.id == id);

            if (kandidat) {
                // Show confirmation dialog first
                Swal.fire({
                    title: 'Edit Kandidat',
                    text: `Apakah Anda yakin ingin mengedit data ${kandidat.nama}?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '<i class="fas fa-edit mr-2"></i>Ya, Edit',
                    cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-xl px-6 py-3 font-semibold',
                        cancelButton: 'rounded-xl px-6 py-3 font-semibold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Isi form dengan data kandidat
                        document.getElementById('editNama').value = kandidat.nama;
                        document.getElementById('editJenisKelamin').value = kandidat.jenis_kelamin;
                        document.getElementById('editJabatanTerpilih').value = kandidat.jabatan_terpilih || '';

                        // Set action URL untuk form update
                        const form = document.getElementById('editKandidatForm');
                        form.action = `/kandidat/${kandidat.id}`;

                        // Buka modal edit
                        openEditModal();
                    }
                });
            }
        }

        function deleteKandidat(id, nama) {
            Swal.fire({
                title: 'Hapus Kandidat',
                text: `Apakah Anda yakin ingin menghapus kandidat ${nama}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus',
                cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-3 font-semibold',
                    cancelButton: 'rounded-xl px-6 py-3 font-semibold'
                },
                backdrop: `
                rgba(0,0,0,0.7)
                center
                no-repeat
            `
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus Data...',
                        text: 'Mohon tunggu sebentar',
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-2xl'
                        },
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Create form untuk delete
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/kandidat/${id}`;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    const tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = '_token';
                    tokenInput.value = '{{ csrf_token() }}';

                    form.appendChild(methodInput);
                    form.appendChild(tokenInput);
                    document.body.appendChild(form);

                    form.submit();
                }
            });
        }

        // Update form submission handlers untuk show success/error alerts
        document.getElementById('editKandidatForm').addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Menyimpan Perubahan...',
                text: 'Mohon tunggu sebentar',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-2xl'
                },
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            this.submit();
        });

        // Add success/error handling for form submissions
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#10b981',
                confirmButtonText: '<i class="fas fa-check mr-2"></i>OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-3 font-semibold'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                confirmButtonText: '<i class="fas fa-times mr-2"></i>OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-3 font-semibold'
                }
            });
        @endif

        @if($errors->any())
            Swal.fire({
                title: 'Terjadi Kesalahan!',
                html: `
                                                                <div class="text-left">
                                                                    <ul class="list-disc list-inside">
                                                                        @foreach($errors->all() as $error)
                                                                            <li class="text-red-600">{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            `,
                icon: 'error',
                confirmButtonColor: '#ef4444',
                confirmButtonText: '<i class="fas fa-times mr-2"></i>OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-6 py-3 font-semibold'
                }
            });
        @endif

        // Add form submission handler for add kandidat form
        document.querySelector('form[action="{{ route('kandidat.store') }}"]').addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Menyimpan Data...',
                text: 'Mohon tunggu sebentar',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-2xl'
                },
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form
            this.submit();
        });

        // Custom styling for SweetAlert
        const swalCustomStyle = document.createElement('style');
        swalCustomStyle.innerHTML = `
            .swal2-popup {
                font-family: inherit !important;
            }
            .swal2-title {
                font-weight: 700 !important;
            }
            .swal2-content {
                font-size: 16px !important;
            }
            .swal2-confirm, .swal2-cancel {
                font-weight: 600 !important;
                transition: all 0.3s ease !important;
            }
            .swal2-confirm:hover, .swal2-cancel:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
            }
        `;
        document.head.appendChild(swalCustomStyle);

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal();
                closeKelolaModal();
                closeEditModal();
            }
        });
    </script>
</body>

</html>