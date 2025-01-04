@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Presensi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/user') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data Presensi</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Presensi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                                    </div>
                                    <div class="col-md-6">
                                        <select id="filterSelect" class="form-control">
                                            <option value="">Semua</option>
                                            <option value="Masuk">Masuk</option>
                                            <option value="Keluar">Keluar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="presensiTable" class="table table-bordered table-hover table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Tanggal Presensi</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Lokasi Masuk</th>
                                                <th>Lokasi Keluar</th>
                                                <th>NIK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($presensi as $data)
                                                <tr>
                                                    <td>{{ $data->tgl_presensi }}</td>
                                                    <td>{{ $data->jam_in }}</td>
                                                    <td>{{ $data->jam_out }}</td>
                                                    <td>{{ $data->lokasi_in }}</td>
                                                    <td>{{ $data->lokasi_out }}</td>
                                                    <td>{{ $data->nik }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#presensiTable tbody tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let match = false;
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                        match = true;
                    }
                });
                row.style.display = match ? '' : 'none';
            });
        });

        document.getElementById('filterSelect').addEventListener('change', function() {
            const filterValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#presensiTable tbody tr');
            rows.forEach(row => {
                const jamMasuk = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const jamKeluar = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (filterValue === 'masuk') {
                    row.style.display = jamMasuk ? '' : 'none';
                } else if (filterValue === 'keluar') {
                    row.style.display = jamKeluar ? '' : 'none';
                } else {
                    row.style.display = '';
                }
            });
        });
    </script>
    <style>
        .table {
            margin-top: 20px;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 12px;
        }

        .thead-dark th {
            background-color: #343a40;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .form-control {
            margin-bottom: 10px;
            border-radius: 20px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #13ad7a;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-title {
            font-weight: bold;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
@endsection
