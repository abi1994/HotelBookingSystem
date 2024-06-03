@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Bookings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Models\Booking::count()}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Customers</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Models\User::isCustomer()->count()}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rooms
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{App\Models\Room::count()}}</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Bookings Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                        var ctx = document.getElementById("myAreaChart");
                                        var myLineChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: _labels,
                                                datasets: [{
                                                    label: "Booking",
                                                    lineTension: 0.3,
                                                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                                                    borderColor: "rgba(78, 115, 223, 1)",
                                                    pointRadius: 3,
                                                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                                    pointBorderColor: "rgba(78, 115, 223, 1)",
                                                    pointHoverRadius: 3,
                                                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                                    pointHitRadius: 10,
                                                    pointBorderWidth: 2,
                                                    data: _data,
                                                }],
                                            },
                                            options: {
                                                // Your chart options here...
                                            }
                                        });
                                    });
                                </script>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">RoomType Bookings</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var ctx = document.getElementById("myPieChart");
                                        var myPieChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: _plabels,
                                            datasets: [{
                                            data: _pdata,
                                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                                            }],
                                        },
                                        options: {
                                        },
                                        });
                                    });
                                    </script>
                                    <div class="mt-4 text-center small">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

<!-- Page level plugins -->
<script src="/vendor/chart.js/Chart.min.js"></script>

<script type="text/javascript">
    var _labels={!! json_encode($labels) !!};
    var _data={!! json_encode($data) !!};

    var _plabels={!! json_encode($plabels) !!};
    var _pdata={!! json_encode($pdata) !!};
</script>

@endsection