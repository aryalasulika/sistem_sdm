@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- Office Count Box -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-sm hover-effect">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-building"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Office</span>
                                <span class="info-box-number">
                                    {{ $officeCount }}
                                    <small>Total</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Users Box -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-sm hover-effect">
                            <span class="info-box-icon bg-success elevation-1">
                                <i class="fas fa-users"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Users</span>
                                <span class="info-box-number">{{ $userCount ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Box -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-sm hover-effect">
                            <span class="info-box-icon bg-warning elevation-1">
                                <i class="fas fa-clock"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Today's Attendance</span>
                                <span class="info-box-number">{{ $attendanceCount ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Active Shifts Box -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 shadow-sm hover-effect">
                            <span class="info-box-icon bg-danger elevation-1">
                                <i class="fas fa-calendar-check"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active Shifts</span>
                                <span class="info-box-number">{{ $activeShifts ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header border-0">
                                <h3 class="card-title">Monthly Statistics</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyStats" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-header border-0">
                                <h3 class="card-title">Quick Actions</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group">
                                    <a href="{{ route('admin.klinik') }}" class="list-group-item list-group-item-action">
                                        <i class="fas fa-building mr-2"></i> Manage Offices
                                    </a>
                                    <a href="{{ route('admin.index') }}" class="list-group-item list-group-item-action">
                                        <i class="fas fa-users mr-2"></i> Manage Users
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <i class="fas fa-clock mr-2"></i> View Attendance
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add custom styles -->
    <style>
        .hover-effect {
            transition: transform 0.2s;
        }

        .hover-effect:hover {
            transform: translateY(-5px);
        }

        .info-box {
            border-radius: 0.25rem;
        }

        .card {
            border-radius: 0.25rem;
        }
    </style>

    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('monthlyStats').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Attendance',
                        data: [65, 59, 80, 81, 56, 55],
                        borderColor: '#17a2b8',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
@endsection
