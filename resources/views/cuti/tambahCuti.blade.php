<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Cuti</title>

    <link rel="shortcut icon" href="{{ asset('lte/plugins/favicon.ico') }}">
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Leaflet --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- end leaflet --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        h2.text-center {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            border-color: #4e73df;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.4);
        }

        .input-group-text {
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 0 10px 10px 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Animasi untuk input shift baru */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mb-3.input-group {
            animation: fadeIn 0.3s ease-out;
        }

        #map {
            height: 300px;
            width: 100%;
            border-radius: 10px;
        }

        /* untuk tabel pencarian */
        .address {
            padding: 10px 15px;
            margin: 5px 0;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #2c3e50;
        }

        .address:hover {
            background-color: #4e73df;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(78, 115, 223, 0.2);
        }

        /* Styling untuk container hasil pencarian */
        #results {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 10px;
            padding: 5px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Scrollbar styling */
        #results::-webkit-scrollbar {
            width: 8px;
        }

        #results::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #results::-webkit-scrollbar-thumb {
            background: #4e73df;
            border-radius: 4px;
        }

        #results::-webkit-scrollbar-thumb:hover {
            background: #224abe;
        }

        /* Loading state */
        .address.loading {
            position: relative;
            overflow: hidden;
        }

        .address.loading::after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }
    </style>
    </style>

    @csrf
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Tambah Data Kategori Cuti</h2>
        <form action="#" method="POST">
            <div class="row">
                <div class="col-12 text-end mb-4">
                    <button type="submit" class="btn btn-primary text-right">Simpan Data</button>
                </div>
                <div class="form-group col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Kategori Cuti</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama_cuti" class="form-control"
                                            placeholder="Nama Cuti" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Cuti</label>
                                        <div class="input-group">
                                            <input type="number" name="jumlah_cuti" class="form-control" required>
                                            <span class="input-group-text">/hari</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-3 mt-4">
                                <a href="{{ route('admin.cuti') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i>Kembali
                                </a>
                            </div>
                            {{-- <button type="button" class="btn btn-primary mt-2" id="addShift">Tambah Shift</button> --}}
                            {{-- <button type="submit" class="btn btn-success mt-2 ms-2">Simpan Semua Shift</button> --}}
                        </div>
                    </div>
                </div>
                <!-- Kolom Data Perusahaan -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Data Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td><input type="checkbox" name="selected[]" value="{{ $user->id }}">
                                            </td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    </div>

    <!-- Link Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Start map --}}

    {{-- End Map --}}

    {{-- Start Dynamic Form Data Shift --}}
    <script>
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        selectAll.addEventListener('click', (event) => {
            checkboxes.forEach(checkbox => {
                checkbox.checked = event.target.checked;
            });
        });
    </script>
    {{-- End Dynamic Form Data Shift --}}

</body>

</html>
