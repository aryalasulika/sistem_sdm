<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dinamis dengan Bootstrap</title>
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
    </style>

</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">FORM PENGISIAN DATA PERUSAHAAN DAN DATA SHIFT</h2>
        <div class="row">
            <!-- Kolom Data Perusahaan -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Perusahaan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form action="{{ route('admin.data_perusahaan') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Perusahaan</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                    placeholder="Masukan Nama Perusahaan">
                                @error('nama')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- Start Map --}}
                            <div class="form-group">
                                <div id="map"></div>
                                <script>
                                    var map = L.map('map').setView([-7.8242112, 110.3803479], 13);
                                    let marker;

                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19,
                                    }).addTo(map);

                                    function onMapClick(e) {
                                        if (marker) {
                                            map.removeLayer(marker);
                                        }

                                        marker = L.marker(e.latlng).addTo(map);

                                        document.querySelector('input[name="latitude"]').value = e.latlng.lat;
                                        document.querySelector('input[name="longitude"]').value = e.latlng.lng;
                                    }

                                    map.on('click', onMapClick);
                                </script>
                                {{-- End Map --}}
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">latitude</label>
                                <input type="text" name="latitude" class="form-control" id="exampleInputEmail1"
                                    placeholder="Masukan latitude">
                                @error('latitude')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">longitude</label>
                                <input type="text" name="longitude" class="form-control" id="exampleInputEmail1"
                                    placeholder="Masukan longitude">
                                @error('longitude')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">Radius (meter)</label>
                                <div class="input-group">
                                    <input type="number" name="radius" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukan radius">
                                    <span class="input-group-text">m</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Data Shift -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Data Shift</h3>
                    </div>
                    <div class="card-body">
                        <form id="shiftForm">
                            <div class="shift-container">
                                <div class="shift-item">
                                    <div class="form-group">
                                        <label>Nama Shift</label>
                                        <input type="text" name="shifts[0][nama_shift]" class="form-control"
                                            placeholder="Masukan Nama Shift" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jam Masuk</label>
                                        <input type="time" name="shifts[0][jam_masuk]" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jam Keluar</label>
                                        <input type="time" name="shifts[0][jam_keluar]" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="button" class="btn btn-danger btn-remove"
                                            style="display: none;">Hapus Shift</button>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-2" id="addShift">Tambah Shift</button>
                            <button type="submit" class="btn btn-success mt-2 ms-2">Simpan Semua Shift</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('admin.klinik') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let shiftIndex = 0;

            // Fungsi untuk menambah form shift baru
            $('#addShift').click(function() {
                shiftIndex++;
                let newShift = `
                    <div class="shift-item">
                        <div class="form-group">
                            <label>Nama Shift</label>
                            <input type="text" name="shifts[${shiftIndex}][nama_shift]" class="form-control" placeholder="Masukan Nama Shift" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Masuk</label>
                            <input type="time" name="shifts[${shiftIndex}][jam_masuk]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jam Keluar</label>
                            <input type="time" name="shifts[${shiftIndex}][jam_keluar]" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-danger btn-remove">Hapus Shift</button>
                        </div>
                        <hr>
                    </div>
                `;
                $('.shift-container').append(newShift);
            });

            // Fungsi untuk menghapus form shift
            $(document).on('click', '.btn-remove', function() {
                $(this).closest('.shift-item').remove();
            });

            // Handle form submission
            $('#shiftForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    url: '/simpan-shift', // Sesuaikan dengan route Anda
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Data shift berhasil disimpan!');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menyimpan data!');
                    }
                });
            });
        });
    </script>
</body>

</html>
