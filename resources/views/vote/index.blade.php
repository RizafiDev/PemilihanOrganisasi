<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteApp - PemilihanModern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'slide-up': 'slideUp 0.2s ease-out',
                        'bounce-subtle': 'bounceSubtle 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        bounceSubtle: {
                            '0%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.02)' },
                            '100%': { transform: 'scale(1)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Modern Clean Background */
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        /* Modern Card Styles */
        .candidate-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #e2e8f0;
        }

        .candidate-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }

        .candidate-card.selected {
            border: 2px solid #3b82f6;
            background: rgba(59, 130, 246, 0.05);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        }

        .candidate-card.selected::after {
            content: '✓';
            position: absolute;
            top: 12px;
            right: 12px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        /* Position Option Styles */
        .position-option {
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
        }

        .position-option:hover {
            border-color: #3b82f6;
            background: rgba(59, 130, 246, 0.02);
        }

        .position-option.selected {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .position-option.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f8fafc;
        }

        /* Progress Bar */
        .progress-bar {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            transition: width 0.3s ease;
        }

        /* Photo frame */
        .photo-frame {
            transition: transform 0.2s ease;
        }

        .photo-frame:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 ">
    <div class="container mx-auto px-4 max-w-7xl py-8">
        <!-- Modern Clean Header -->
        <div class="text-center mb-12 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mx-auto max-w-7xl">
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-gray-900 mb-3">
                        Pemilihan Organisasi Digital
                    </h1>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                        Pilih 1 kandidat untuk setiap jabatan di Kandidat Putra dan Putri
                    </p>
                </div>

                <div class="flex justify-center space-x-6">
                    <div class="flex items-center space-x-3 bg-blue-50 px-5 py-3 rounded-xl border border-blue-100">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-sm font-semibold text-blue-700">Kandidat Putra</span>
                    </div>
                    <div class="flex items-center space-x-3 bg-pink-50 px-5 py-3 rounded-xl border border-pink-100">
                        <div class="w-3 h-3 bg-pink-500 rounded-full"></div>
                        <span class="text-sm font-semibold text-pink-700">Kandidat Putri</span>
                    </div>
                </div>
            </div>
        </div>



        <form id="voting-form" action="{{ route('vote.store') }}" method="POST">
            @csrf

            <!-- Kandidat Putra -->
            <div class="mb-16 animate-fade-in">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center py-6">
                        <h2 class="text-2xl font-bold mb-1">Kandidat Putra</h2>
                        <p class="text-blue-100">Pilih 3 kandidat untuk jabatan yang berbeda</p>
                    </div>

                    <div class="p-8">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6">
                            <!-- Sample Putra Candidates -->
                            <div class="candidate-card bg-white rounded-xl p-6 relative" data-kategori="putra"
                                data-kandidat-id="1" data-nama="Ahmad Fauzi">

                                <div class="text-center mb-6">
                                    <div
                                        class="photo-frame w-20 h-20 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full overflow-hidden mb-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-white text-2xl font-bold">A</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-1">Ahmad Fauzi</h3>
                                    <p class="text-gray-500 text-sm">Kandidat Putra</p>
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Jabatan:</label>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="pradana"
                                        data-kategori="putra" data-kandidat-id="1">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pradana Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="wakil"
                                        data-kategori="putra" data-kandidat-id="1">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Wakil Pradana Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="adat"
                                        data-kategori="putra" data-kandidat-id="1">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pemangku Adat Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Putra Candidates -->
                            <div class="candidate-card bg-white rounded-xl p-6 relative" data-kategori="putra"
                                data-kandidat-id="2" data-nama="Budi Santoso">

                                <div class="text-center mb-6">
                                    <div
                                        class="photo-frame w-20 h-20 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full overflow-hidden mb-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-white text-2xl font-bold">B</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-1">Budi Santoso</h3>
                                    <p class="text-gray-500 text-sm">Kandidat Putra</p>
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Jabatan:</label>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="pradana"
                                        data-kategori="putra" data-kandidat-id="2">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pradana Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="wakil"
                                        data-kategori="putra" data-kandidat-id="2">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Wakil Pradana Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="adat"
                                        data-kategori="putra" data-kandidat-id="2">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pemangku Adat Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="candidate-card bg-white rounded-xl p-6 relative" data-kategori="putra"
                                data-kandidat-id="3" data-nama="Chandra Wijaya">

                                <div class="text-center mb-6">
                                    <div
                                        class="photo-frame w-20 h-20 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full overflow-hidden mb-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-white text-2xl font-bold">C</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-1">Chandra Wijaya</h3>
                                    <p class="text-gray-500 text-sm">Kandidat Putra</p>
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Jabatan:</label>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="pradana"
                                        data-kategori="putra" data-kandidat-id="3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pradana Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="wakil"
                                        data-kategori="putra" data-kandidat-id="3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Wakil Pradana Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="adat"
                                        data-kategori="putra" data-kandidat-id="3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pemangku Adat Putra</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kandidat Putri -->
            <div class="mb-16 animate-fade-in">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-pink-500 to-pink-600 text-white text-center py-6">
                        <h2 class="text-2xl font-bold mb-1">Kandidat Putri</h2>
                        <p class="text-pink-100">Pilih 3 kandidat untuk jabatan yang berbeda</p>
                    </div>

                    <div class="p-8">
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6">
                            <!-- Sample Putri Candidates -->
                            <div class="candidate-card bg-white rounded-xl p-6 relative" data-kategori="putri"
                                data-kandidat-id="4" data-nama="Aisyah Putri">

                                <div class="text-center mb-6">
                                    <div
                                        class="photo-frame w-20 h-20 mx-auto bg-gradient-to-br from-pink-400 to-pink-600 rounded-full overflow-hidden mb-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-white text-2xl font-bold">A</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-1">Aisyah Putri</h3>
                                    <p class="text-gray-500 text-sm">Kandidat Putri</p>
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Jabatan:</label>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="pradana"
                                        data-kategori="putri" data-kandidat-id="4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pradana Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="wakil"
                                        data-kategori="putri" data-kandidat-id="4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Wakil Pradana Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="adat"
                                        data-kategori="putri" data-kandidat-id="4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pemangku Adat Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="candidate-card bg-white rounded-xl p-6 relative" data-kategori="putri"
                                data-kandidat-id="5" data-nama="Bella Sari">

                                <div class="text-center mb-6">
                                    <div
                                        class="photo-frame w-20 h-20 mx-auto bg-gradient-to-br from-pink-400 to-pink-600 rounded-full overflow-hidden mb-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-white text-2xl font-bold">B</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-1">Bella Sari</h3>
                                    <p class="text-gray-500 text-sm">Kandidat Putri</p>
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Jabatan:</label>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="pradana"
                                        data-kategori="putri" data-kandidat-id="5">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pradana Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="wakil"
                                        data-kategori="putri" data-kandidat-id="5">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Wakil Pradana Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="adat"
                                        data-kategori="putri" data-kandidat-id="5">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pemangku Adat Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="candidate-card bg-white rounded-xl p-6 relative" data-kategori="putri"
                                data-kandidat-id="6" data-nama="Citra Dewi">

                                <div class="text-center mb-6">
                                    <div
                                        class="photo-frame w-20 h-20 mx-auto bg-gradient-to-br from-pink-400 to-pink-600 rounded-full overflow-hidden mb-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-white text-2xl font-bold">C</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-xl text-gray-900 mb-1">Citra Dewi</h3>
                                    <p class="text-gray-500 text-sm">Kandidat Putri</p>
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Jabatan:</label>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="pradana"
                                        data-kategori="putri" data-kandidat-id="6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pradana Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="wakil"
                                        data-kategori="putri" data-kandidat-id="6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Wakil Pradana Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-option p-3 rounded-lg cursor-pointer" data-position="adat"
                                        data-kategori="putri" data-kandidat-id="6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                                                <span class="font-medium text-sm">Pemangku Adat Putri</span>
                                            </div>
                                            <div class="position-status hidden">
                                                <span
                                                    class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Terpilih</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Clean Progress Bar -->
            <div class="mb-12 animate-slide-up ">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6  mx-auto max-w-7xl">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-900 font-semibold text-lg">Progress Pemilihan</span>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                <span id="selected-count">0</span>/6
                            </span>
                        </div>
                        <div class="text-gray-600 text-sm font-medium">
                            <span id="progress-percentage">0%</span>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div id="progress-bar" class="progress-bar h-3 rounded-full" style="width: 0%"></div>
                    </div>
                    <div class="mt-3 text-gray-600 text-sm text-center">
                        <span id="progress-text">Mulai memilih kandidat favorit Anda</span>
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="text-center animate-fade-in">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 max-w-7xl mx-auto">
                    <button type="submit" id="submit-btn"
                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:from-gray-400 disabled:to-gray-500"
                        disabled>
                        <span class="flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Submit Pilihan</span>
                        </span>
                    </button>
                    <p class="text-gray-600 text-sm mt-4">
                        <span class="inline-block w-2 h-2 bg-orange-400 rounded-full mr-2"></span>
                        Pastikan Anda telah memilih 6 kandidat (3 putra, 3 putri)
                    </p>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Define positionLabels at the top so it's accessible everywhere
            const positionLabels = {
                pradana: 'Pradana',
                wakil: 'Wakil Pradana',
                adat: 'Pemangku Adat'
            };

            // Check if user has already voted
            function hasVoted() {
                return document.cookie.split(';').some(cookie =>
                    cookie.trim().startsWith('has_voted=true')
                );
            }

            function setVoteCookie() {
                // Set cookie that expires in 30 days
                const expirationDate = new Date();
                expirationDate.setDate(expirationDate.getDate() + 30);
                document.cookie = `has_voted=true; expires=${expirationDate.toUTCString()}; path=/; SameSite=Strict`;
            }

            // Check if user has already voted on page load
            if (hasVoted()) {
                // Make the page readonly instead of redirecting
                makePageReadonly();

                Swal.fire({
                    title: 'Sudah Pernah Voting',
                    text: 'Anda sudah pernah melakukan voting pada perangkat ini. Halaman ini dalam mode tampilan saja.',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3b82f6'
                });
                return;
            }

            function makePageReadonly() {
                // Disable the form
                const form = document.getElementById('voting-form');
                form.style.pointerEvents = 'none';
                form.style.cursor = 'block';

                // Get saved selections from localStorage if available
                const savedSelectionsString = localStorage.getItem('voteSelections');
                let savedSelections = null;

                // Safely parse and validate the saved selections
                try {
                    if (savedSelectionsString) {
                        savedSelections = JSON.parse(savedSelectionsString);

                        // Validate structure - ensure both putra and putri objects exist
                        if (!savedSelections || typeof savedSelections !== 'object') {
                            savedSelections = null;
                        } else {
                            // Ensure putra and putri objects exist with proper structure
                            if (!savedSelections.putra || typeof savedSelections.putra !== 'object') {
                                savedSelections.putra = { pradana: null, wakil: null, adat: null };
                            }
                            if (!savedSelections.putri || typeof savedSelections.putri !== 'object') {
                                savedSelections.putri = { pradana: null, wakil: null, adat: null };
                            }
                        }
                    }
                } catch (error) {
                    console.error('Error parsing saved selections:', error);
                    savedSelections = null;
                }

                // Apply saved selections visually if they exist
                if (savedSelections && savedSelections.putra) {
                    Object.keys(savedSelections.putra).forEach(position => {
                        if (savedSelections.putra[position]) {
                            const kandidatId = savedSelections.putra[position];
                            const card = document.querySelector(`[data-kandidat-id="${kandidatId}"]`);
                            const positionOption = card?.querySelector(`[data-position="${position}"]`);

                            if (card && positionOption) {
                                card.classList.add('selected');
                                positionOption.classList.add('selected');
                                const statusElement = positionOption.querySelector('.position-status');
                                if (statusElement) {
                                    statusElement.classList.remove('hidden');
                                }
                            }
                        }
                    });
                }

                if (savedSelections && savedSelections.putri) {
                    Object.keys(savedSelections.putri).forEach(position => {
                        if (savedSelections.putri[position]) {
                            const kandidatId = savedSelections.putri[position];
                            const card = document.querySelector(`[data-kandidat-id="${kandidatId}"]`);
                            const positionOption = card?.querySelector(`[data-position="${position}"]`);

                            if (card && positionOption) {
                                card.classList.add('selected');
                                positionOption.classList.add('selected');
                                const statusElement = positionOption.querySelector('.position-status');
                                if (statusElement) {
                                    statusElement.classList.remove('hidden');
                                }
                            }
                        }
                    });
                }

                // Update progress bar to show completed state
                document.getElementById('selected-count').textContent = '6';
                document.getElementById('progress-bar').style.width = '100%';
                document.getElementById('progress-percentage').textContent = '100%';

                // Add overlay to indicate readonly state
                document.querySelectorAll('.candidate-card').forEach(card => {
                    if (!card.classList.contains('selected')) {
                        card.style.opacity = '0.3';
                    } else {
                        // Add readonly indicator to selected cards
                        const readonlyBadge = document.createElement('div');
                        readonlyBadge.className = 'absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-semibold z-10';
                        readonlyBadge.innerHTML = '✓ Terpilih';
                        card.style.position = 'relative';
                        card.appendChild(readonlyBadge);
                    }
                });

                // Disable submit button and change text
                const submitBtn = document.getElementById('submit-btn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <span class="flex items-center justify-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Voting Sudah Selesai</span>
                    </span>
                `;
                submitBtn.classList.remove('bg-gradient-to-r', 'from-indigo-500', 'to-purple-600', 'hover:from-indigo-600', 'hover:to-purple-700');
                submitBtn.classList.add('bg-green-500', 'cursor-not-allowed');

                // Update progress text
                const progressText = document.getElementById('progress-text');
                progressText.textContent = '✅ Voting berhasil diselesaikan - Mode tampilan hasil';
                progressText.classList.add('text-green-600', 'font-semibold');

                // Add readonly badge to header
                const header = document.querySelector('.container .text-center .bg-white');
                const readonlyBadge = document.createElement('div');
                readonlyBadge.className = 'bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded-lg mt-4 mx-auto max-w-md';
                readonlyBadge.innerHTML = `
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">Voting Selesai - Menampilkan Pilihan Anda</span>
                    </div>
                `;
                header.appendChild(readonlyBadge);

                // Add voting summary section only if we have valid saved selections
                if (savedSelections && savedSelections.putra && savedSelections.putri) {
                    const summarySection = document.createElement('div');
                    summarySection.className = 'bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 my-6 mx-auto max-w-7xl';

                    // Generate putra summary with safety checks
                    const putraSummary = Object.keys(savedSelections.putra)
                        .map(position => {
                            if (savedSelections.putra[position]) {
                                const kandidatId = savedSelections.putra[position];
                                const kandidat = document.querySelector(`[data-kandidat-id="${kandidatId}"]`);
                                const nama = kandidat?.dataset.nama || 'Kandidat Tidak Ditemukan';
                                const positionLabel = positionLabels[position] || position;
                                return `
                                    <div class="flex justify-between items-center bg-white p-2 rounded-lg">
                                        <span class="text-sm font-medium">${positionLabel}</span>
                                        <span class="text-sm text-blue-700 font-semibold">${nama}</span>
                                    </div>
                                `;
                            }
                            return '';
                        })
                        .filter(item => item !== '')
                        .join('');

                    // Generate putri summary with safety checks
                    const putriSummary = Object.keys(savedSelections.putri)
                        .map(position => {
                            if (savedSelections.putri[position]) {
                                const kandidatId = savedSelections.putri[position];
                                const kandidat = document.querySelector(`[data-kandidat-id="${kandidatId}"]`);
                                const nama = kandidat?.dataset.nama || 'Kandidat Tidak Ditemukan';
                                const positionLabel = positionLabels[position] || position;
                                return `
                                    <div class="flex justify-between items-center bg-white p-2 rounded-lg">
                                        <span class="text-sm font-medium">${positionLabel}</span>
                                        <span class="text-sm text-pink-700 font-semibold">${nama}</span>
                                    </div>
                                `;
                            }
                            return '';
                        })
                        .filter(item => item !== '')
                        .join('');

                    summarySection.innerHTML = `
                        <h3 class="text-xl font-bold text-green-800 mb-4 text-center">📋 Ringkasan Pilihan Anda</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
                                <h4 class="font-bold text-blue-800 mb-3 flex items-center">
                                    <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                                    Kandidat Putra Terpilih
                                </h4>
                                <div class="space-y-2">
                                    ${putraSummary || '<p class="text-sm text-gray-500">Tidak ada data tersimpan</p>'}
                                </div>
                            </div>
                            <div class="bg-pink-50 p-4 rounded-xl border border-pink-200">
                                <h4 class="font-bold text-pink-800 mb-3 flex items-center">
                                    <span class="w-3 h-3 bg-pink-500 rounded-full mr-2"></span>
                                    Kandidat Putri Terpilih
                                </h4>
                                <div class="space-y-2">
                                    ${putriSummary || '<p class="text-sm text-gray-500">Tidak ada data tersimpan</p>'}
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-sm text-green-700">
                                <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Terima kasih! Pilihan Anda telah berhasil disimpan.
                            </p>
                        </div>
                    `;

                    // Insert summary after header
                    const headerSection = document.querySelector('.container .text-center.mb-12');
                    if (headerSection) {
                        headerSection.insertAdjacentElement('afterend', summarySection);
                    }
                }


            }

            const selectedPositions = {
                putra: {
                    pradana: null,
                    wakil: null,
                    adat: null
                },
                putri: {
                    pradana: null,
                    wakil: null,
                    adat: null
                }
            };

            function updateProgress() {
                const totalSelected = Object.values(selectedPositions.putra).filter(v => v !== null).length +
                    Object.values(selectedPositions.putri).filter(v => v !== null).length;

                const percentage = Math.round((totalSelected / 6) * 100);

                document.getElementById('selected-count').textContent = totalSelected;
                document.getElementById('progress-bar').style.width = percentage + '%';
                document.getElementById('progress-percentage').textContent = percentage + '%';

                const progressText = document.getElementById('progress-text');
                if (totalSelected === 0) {
                    progressText.textContent = 'Mulai memilih kandidat favorit Anda';
                } else if (totalSelected < 6) {
                    progressText.textContent = `Pilih ${6 - totalSelected} kandidat lagi untuk melengkapi`;
                } else {
                    progressText.textContent = '🎉 Pilihan lengkap! Siap untuk submit';
                }

                const submitBtn = document.getElementById('submit-btn');
                submitBtn.disabled = totalSelected < 6;

                if (totalSelected === 6) {
                    submitBtn.classList.add('animate-pulse');
                    submitBtn.classList.add('glow');
                } else {
                    submitBtn.classList.remove('animate-pulse');
                    submitBtn.classList.remove('glow');
                }
            }

            function updatePositionAvailability() {
                document.querySelectorAll('.position-option').forEach(option => {
                    const position = option.dataset.position;
                    const kategori = option.dataset.kategori;
                    const kandidatId = option.dataset.kandidatId;

                    // Check if this position is already taken by another candidate
                    const currentHolder = selectedPositions[kategori][position];

                    if (currentHolder && currentHolder !== kandidatId) {
                        // Position is taken by another candidate - disable this option
                        option.classList.add('disabled');
                        option.style.pointerEvents = 'none';
                        option.style.opacity = '0.4';
                    } else {
                        // Position is available - enable this option
                        option.classList.remove('disabled');
                        option.style.pointerEvents = 'auto';
                        option.style.opacity = '1';
                    }
                });
            }

            function updateCardSelection(kandidatId, kategori, position) {
                const card = document.querySelector(`[data-kandidat-id="${kandidatId}"]`);

                // Reset all position options for this candidate
                card.querySelectorAll('.position-option').forEach(option => {
                    option.classList.remove('selected');
                    option.querySelector('.position-status').classList.add('hidden');
                });

                if (position) {
                    // Mark this candidate as selected
                    card.classList.add('selected');

                    // Mark the selected position
                    const selectedOption = card.querySelector(`[data-position="${position}"]`);
                    selectedOption.classList.add('selected');
                    selectedOption.querySelector('.position-status').classList.remove('hidden');

                    // Show success animation
                    card.classList.add('animate-bounce-subtle');
                    setTimeout(() => {
                        card.classList.remove('animate-bounce-subtle');
                    }, 500);

                    // Show SweetAlert notification
                    Swal.fire({
                        title: 'Pilihan Tersimpan!',
                        text: `${card.dataset.nama} terpilih sebagai ${positionLabels[position]} ${kategori.charAt(0).toUpperCase() + kategori.slice(1)}`,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        background: kategori === 'putra' ? '#dbeafe' : '#fce7f3',
                        color: kategori === 'putra' ? '#1e40af' : '#be185d'
                    });
                } else {
                    // No position selected for this candidate
                    card.classList.remove('selected');
                }
            }

            // Handle position option clicks
            document.querySelectorAll('.position-option').forEach(option => {
                option.addEventListener('click', function () {
                    if (this.classList.contains('disabled')) {
                        Swal.fire({
                            title: 'Posisi Tidak Tersedia',
                            text: 'Posisi ini sudah dipilih oleh kandidat lain.',
                            icon: 'warning',
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                        return;
                    }

                    const position = this.dataset.position;
                    const kategori = this.dataset.kategori;
                    const kandidatId = this.dataset.kandidatId;

                    // Check if this position is already selected for this candidate
                    const isCurrentlySelected = selectedPositions[kategori][position] === kandidatId;

                    if (isCurrentlySelected) {
                        // Deselect this position
                        selectedPositions[kategori][position] = null;
                        updateCardSelection(kandidatId, kategori, null);

                        Swal.fire({
                            title: 'Pilihan Dibatalkan',
                            text: `Pilihan untuk posisi ${positionLabels[position]} ${kategori.charAt(0).toUpperCase() + kategori.slice(1)} telah dibatalkan`,
                            icon: 'info',
                            timer: 1500,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        // Clear any previous position selection for this candidate
                        Object.keys(selectedPositions[kategori]).forEach(pos => {
                            if (selectedPositions[kategori][pos] === kandidatId) {
                                selectedPositions[kategori][pos] = null;
                            }
                        });

                        // Set new selection
                        selectedPositions[kategori][position] = kandidatId;
                        updateCardSelection(kandidatId, kategori, position);
                    }

                    updatePositionAvailability();
                    updateProgress();
                });
            });

            // Handle form submission
            document.getElementById('voting-form').addEventListener('submit', function (e) {
                e.preventDefault();

                // Double check if user has already voted
                if (hasVoted()) {
                    Swal.fire({
                        title: 'Sudah Pernah Voting',
                        text: 'Anda sudah pernah melakukan voting pada perangkat ini.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#ef4444'
                    });
                    return;
                }

                const totalSelected = Object.values(selectedPositions.putra).filter(v => v !== null).length +
                    Object.values(selectedPositions.putri).filter(v => v !== null).length;

                if (totalSelected < 6) {
                    Swal.fire({
                        title: 'Pilihan Belum Lengkap',
                        text: `Anda masih perlu memilih ${6 - totalSelected} kandidat lagi.`,
                        icon: 'warning',
                        confirmButtonText: 'OK, Saya Mengerti',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                // Show confirmation dialog
                Swal.fire({
                    title: 'Konfirmasi Pilihan',
                    html: `
                        <div class="text-left">
                            <p class="mb-4">Apakah Anda yakin dengan pilihan berikut?</p>
                            <div class="bg-blue-50 p-4 rounded-lg mb-3">
                                <h4 class="font-bold text-blue-800 mb-2">Kandidat Putra:</h4>
                                <ul class="text-sm text-blue-700">
                                    ${Object.keys(selectedPositions.putra).map(pos => {
                        const kandidatId = selectedPositions.putra[pos];
                        if (kandidatId) {
                            const kandidat = document.querySelector(`[data-kandidat-id="${kandidatId}"]`);
                            return `<li>• ${positionLabels[pos]}: ${kandidat.dataset.nama}</li>`;
                        }
                        return '';
                    }).join('')}
                                </ul>
                            </div>
                            <div class="bg-pink-50 p-4 rounded-lg">
                                <h4 class="font-bold text-pink-800 mb-2">Kandidat Putri:</h4>
                                <ul class="text-sm text-pink-700">
                                    ${Object.keys(selectedPositions.putri).map(pos => {
                        const kandidatId = selectedPositions.putri[pos];
                        if (kandidatId) {
                            const kandidat = document.querySelector(`[data-kandidat-id="${kandidatId}"]`);
                            return `<li>• ${positionLabels[pos]}: ${kandidat.dataset.nama}</li>`;
                        }
                        return '';
                    }).join('')}
                                </ul>
                            </div>
                            <p class="mt-4 text-sm text-red-600 font-semibold">⚠️ PENTING: Pilihan tidak dapat diubah setelah di-submit dan perangkat ini tidak akan bisa voting lagi!</p>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: '✅ Ya, Submit Pilihan',
                    cancelButtonText: '❌ Batal',
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#ef4444',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Mengirim Pilihan...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Prepare form data
                        const votes = [];
                        Object.keys(selectedPositions.putra).forEach(position => {
                            if (selectedPositions.putra[position]) {
                                votes.push(JSON.stringify({
                                    kandidat_id: selectedPositions.putra[position],
                                    jabatan: position
                                }));
                            }
                        });

                        Object.keys(selectedPositions.putri).forEach(position => {
                            if (selectedPositions.putri[position]) {
                                votes.push(JSON.stringify({
                                    kandidat_id: selectedPositions.putri[position],
                                    jabatan: position
                                }));
                            }
                        });

                        // Create FormData
                        const formData = new FormData();
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                        votes.forEach(vote => {
                            formData.append('votes[]', vote);
                        });

                        // Submit to server
                        fetch('{{ route("vote.store") }}', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Save selections to localStorage before setting cookie
                                    localStorage.setItem('voteSelections', JSON.stringify(selectedPositions));

                                    // Set vote cookie AFTER successful submission
                                    setVoteCookie();

                                    // Make page readonly and show selections
                                    makePageReadonly();

                                    Swal.fire({
                                        title: 'Voting Berhasil!',
                                        text: 'Terima kasih! Pilihan Anda telah berhasil disimpan. Halaman ini sekarang menampilkan hasil pilihan Anda.',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: '#10b981'
                                    });

                                    setTimeout(() => location.reload(), 3000);
                                } else {
                                    throw new Error(data.message || 'Terjadi kesalahan saat menyimpan voting');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Gagal',
                                    text: 'Terjadi kesalahan saat menyimpan pilihan: ' + error.message,
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi',
                                    confirmButtonColor: '#ef4444'
                                });
                            });
                    }
                });
            });

            // Initialize
            updateProgress();
            updatePositionAvailability();
        });
    </script>
</body>

</html>