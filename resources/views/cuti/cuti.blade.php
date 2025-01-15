@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pengajuan Cuti</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pengajuan Cuti</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('admin.tambah_cuti') }}" class="btn btn-primary mb-3">Ajukan Cuti</a>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Pengajuan Cuti</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Tanggal Cuti</th>
                                            <th>Jumlah Hari</th>
                                            <th>Alasan</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_cuti as $cuti)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cuti->user->name }}</td>
                                                <td>{{ $cuti->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $cuti->tanggal_mulai }} - {{ $cuti->tanggal_selesai }}</td>
                                                <td>{{ $cuti->jumlah_hari }}</td>
                                                <td>{{ $cuti->alasan }}</td>
                                                <td>
                                                    @if ($cuti->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($cuti->status == 'approved')
                                                        <span class="badge badge-success">Disetujui</span>
                                                    @else
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($cuti->status == 'pending')
                                                        <button class="btn btn-success btn-sm"
                                                            onclick="approveLeave({{ $cuti->id }})">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </button>
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="rejectLeave({{ $cuti->id }})">
                                                            <i class="fas fa-times"></i> Tolak
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
