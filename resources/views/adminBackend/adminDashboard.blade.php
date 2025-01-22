@extends('adminBackend.adminLayout')
@section('content')
<!-- Include Bootstrap CSS for styling -->


<!-- Include ApexCharts Library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Include Icon (Optional) -->

<div class="row g-6">
    <!-- {{-- Profit --}} -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card">
            <div class="row">
                <!-- Profit Section -->
                <div class="col-6">
                    <div class="card-body">
                        <div class="card-info">
                            <h6 class="mb-4 pb-1 text-nowrap">Profit</h6>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="mb-0 me-2">BDT {{ number_format($todayProfit, 2) }}</h4>
                                <!-- Display percentage change -->
                                @if ($percentageChange >= 0)
                                <p class="text-success mb-0">+{{ number_format($percentageChange, 2) }}%</p>
                                @else
                                <p class="text-danger mb-0">{{ number_format($percentageChange, 2) }}%</p>
                                @endif
                            </div>
                            <div class="badge bg-label-primary rounded-pill mb-xl-1">
                                {{ $today->format('d F Y') }} <!-- Display today's date -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expense Section -->
                <div class="col-6">
                    <div class="card-body">
                        <div class="card-info">
                            <h6 class="mb-4 pb-1 text-nowrap">Expense</h6>
                            <h4 class="mb-0">BDT {{ number_format($todayExpense, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-relative">
                {{-- <img src="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/illustrations/illustration-1.png"
                         alt="Illustration"
                         class="position-absolute card-img-position scaleX-n1-rtl bottom-0 w-auto end-0 me-3"
                         width="95"> --}}
            </div>
        </div>
    </div>
    <!-- {{-- End Profit --}} -->

    <!-- {{-- Net Profit --}} -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card">
            <div class="row">
                <!-- Profit Section -->
                <div class="col-6">
                    <div class="card-body">
                        <div class="card-info">
                            <h6 class="mb-4 pb-1 text-nowrap">Net Profit</h6>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0 me-2">BDT {{ number_format($netProfit, 2) }}</h4>
                                <!-- Display percentage change -->
                                @if ($percentageChange >= 0)
                                <p class="text-success mb-0">+{{ number_format($percentageChange, 2) }}%</p>
                                @else
                                <p class="text-danger mb-0">{{ number_format($percentageChange, 2) }}%</p>
                                @endif
                            </div>
                            <div class="badge bg-label-primary rounded-pill mb-xl-1">
                                {{ $today->format('d F Y') }} <!-- Display today's date -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-relative">
                <img src="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/illustrations/illustration-1.png"
                    alt="Illustration"
                    class="position-absolute card-img-position scaleX-n1-rtl bottom-0 w-auto end-0 me-3" width="95">
            </div>
        </div>
    </div>
    <!-- {{-- End Net Profit --}} -->

    <!-- {{-- Transaction --}} -->
    <div class="col-xxl-6 align-self-end">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Transactions</h5>
                    <div class="dropdown">
                        <button class="btn text-muted p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ri-more-2-line ri-24px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Share</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);">Update</a>
                        </div>
                    </div>
                </div>
                <p class="small mb-0">
                    <span class="h6 mb-0">{{ number_format($currentMonthProfit, 2) }} Profit</span>
                    @if ($percentageProfitGrowth >= 0)
                    <span class="text-success">+{{ number_format($percentageProfitGrowth, 2) }}%</span> this month
                    @else
                    <span class="text-danger">{{ number_format($percentageProfitGrowth, 2) }}%</span> this month
                    @endif
                </p>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-primary rounded shadow-xs">
                                    <i class="ri-pie-chart-2-line ri-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0">Total Sales</p>
                                <h5 class="mb-0">{{ number_format($currentMonthSalesCount, 0) }}</h5>
                                <!-- Display total sales count -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-success rounded shadow-xs">
                                    <i class="ri-group-line ri-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0">Customers</p>
                                <h5 class="mb-0">{{ number_format($totalCustomersThisMonth, 0) }}</h5>
                                <!-- Assuming customer count is similar to currentMonthProfit -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-warning rounded shadow-xs">
                                    <i class="ri-macbook-line ri-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0">Product</p>
                                <h5 class="mb-0">{{ number_format($totalProductSalesThisMonth, 0) }}</h5>
                                <!-- Replaced $formattedProducts with $currentMonthRevenue -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                                <div class="avatar-initial bg-info rounded shadow-xs">
                                    <i class="ri-money-dollar-circle-line ri-24px"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0">Revenue</p>
                                <h5 class="mb-0">{{ number_format($currentMonthRevenue, 0) }}</h5>
                                <!-- Replaced $formattedRevenue with $currentMonthRevenue -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- {{-- End Transaction --}} -->



    <!-- {{-- 6 months Data --}} -->
    <div class="col-xxl-3 col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-1">Total Sales (Last 6 Months)</h5>
                    <p class="card-subtitle mb-0" id="totalSalesAmount"></p>
                </div>
            </div>
            <div class="card-body" style="position: relative;">
                <div id="totalSalesChart" style="min-height: 230px;"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            // Get the data passed from the controller
            const months = <?php echo json_encode($data['months']); ?>;
            const salesData = <?php echo json_encode($data['salesData']); ?>;

            // Ensure the data is in the correct format by logging
            console.log("Months: ", months);
            console.log("Sales Data: ", salesData);

            // Check if the DOM element exists before initializing the chart
            const chartElement = document.querySelector("#totalSalesChart");
            if (chartElement && months.length > 0 && salesData.length > 0) {
                // Define chart options
                const options = {
                    chart: {
                        type: 'line',
                        height: 250,
                        toolbar: {
                            show: false
                        }
                    },
                    series: [{
                        name: 'Total Sales (BDT)',
                        data: salesData // Ensure this is a valid array of numbers
                    }],
                    xaxis: {
                        categories: months, // Ensure months is a valid array of strings
                        title: {
                            text: 'Months',
                            style: {
                                fontSize: '14px',
                                fontWeight: 'bold',
                                color: '#333' // Set color to dark for visibility
                            }
                        },
                        labels: {
                            style: {
                                fontSize: '12px',
                                colors: '#6c757d' // Lighter text color for x-axis labels
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Sales (BDT)',
                            style: {
                                fontSize: '14px',
                                fontWeight: 'bold',
                                color: '#333' // Ensure y-axis title color is dark for readability
                            }
                        },
                        labels: {
                            formatter: function(value) {
                                return 'BDT ' + value
                                    .toLocaleString(); // Format the numbers with a currency prefix
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return 'BDT ' + value.toLocaleString(); // Format tooltip value with 'BDT'
                            }
                        }
                    },
                    stroke: {
                        curve: 'smooth', // Smooth the line for better visualization
                        width: 2 // Set line width to 2 for visibility
                    },
                    colors: ['#28a745'], // Green color for the line
                    grid: {
                        borderColor: '#f1f1f1', // Set a light color for the grid border
                        padding: {
                            top: 10,
                            right: 10,
                            bottom: 10,
                            left: 10
                        }
                    },
                    markers: {
                        size: 4, // Markers to highlight data points
                        colors: ['#fff'], // White color for markers
                        strokeColor: '#28a745', // Green stroke for markers
                        strokeWidth: 2 // Marker stroke width for emphasis
                    },
                    dataLabels: {
                        enabled: false // Disable data labels to avoid cluttering
                    }
                };

                // Initialize ApexCharts and render the chart
                const chart = new ApexCharts(chartElement, options);
                chart.render();
            } else {
                console.error("Chart container or data is missing!");
            }
        });
    </script>
    <!-- {{-- End 6 months Data --}} -->


    <!-- {{-- Earning Vs Expense --}} -->
    <div class="col-xxl-3 col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-0">Earning vs Expense</h5>
                    <div class="dropdown">
                        <button class="btn text-muted p-0" type="button" id="revenueReportDropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-more-2-line ri-24px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="revenueReportDropdown">
                            <a class="dropdown-item waves-effect" href="javascript:void(0);" id="last28Days">Last 28
                                Days</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);" id="lastMonth">Last
                                Month</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0);" id="lastYear">Last
                                Year</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="position: relative;">
                <!-- Chart Container -->
                <div id="earningVsExpenseChart" style="min-height: 240px;"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            // Example data for Earning and Expense
            const months = <?php echo json_encode($data['months']); ?>;
            const earningData = <?php echo json_encode($data['earningData']); ?>; // Example earning data
            const expenseData = <?php echo json_encode($data['expenseData']); ?>; // Example expense data

            // Ensure the data is in the correct format by logging
            console.log("Months: ", months);
            console.log("Earning Data: ", earningData);
            console.log("Expense Data: ", expenseData);

            // Check if the DOM element exists before initializing the chart
            const chartElement = document.querySelector("#earningVsExpenseChart");
            if (chartElement && months.length > 0 && earningData.length > 0 && expenseData.length > 0) {
                // Define chart options
                const options = {
                    chart: {
                        type: 'line',
                        height: 250,
                        toolbar: {
                            show: false
                        }
                    },
                    series: [{
                        name: 'Earning',
                        data: earningData,
                        color: '#56ca00' // Green for Earning
                    }, {
                        name: 'Expense',
                        data: expenseData,
                        color: '#8a8d93' // Gray for Expense
                    }],
                    xaxis: {
                        categories: months,
                        title: {
                            // text: 'Months',
                            style: {
                                fontSize: '14px',
                                fontWeight: 'bold',
                                color: '#333'
                            }
                        },
                        labels: {
                            style: {
                                fontSize: '12px',
                                colors: '#6c757d'
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Amount (BDT)',
                            style: {
                                fontSize: '14px',
                                fontWeight: 'bold',
                                color: '#333'
                            }
                        },
                        labels: {
                            formatter: function(value) {
                                return 'BDT ' + value.toLocaleString();
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return 'BDT ' + value.toLocaleString();
                            }
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                        padding: {
                            top: 10,
                            right: 10,
                            bottom: 10,
                            left: 10
                        }
                    },
                    markers: {
                        size: 4,
                        colors: ['#fff'],
                        strokeColor: '#56ca00', // Green stroke for Earning markers
                        strokeWidth: 2
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        floating: true,
                        offsetY: 5
                    }
                };

                // Initialize ApexCharts and render the chart
                const chart = new ApexCharts(chartElement, options);
                chart.render();
            } else {
                console.error("Chart container or data is missing!");
            }
        });
    </script>
    <!-- {{-- Earning Vs Expense --}} -->

    <!-- Sales Overview -->
<div class="col-xl-6">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Sales Overview</h5>
                <div class="dropdown">
                    <button class="btn text-muted p-0" type="button" id="salesOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-more-2-line ri-24px"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesOverviewDropdown">
                        <a class="dropdown-item waves-effect" href="javascript:void(0);">Last 28 Days</a>
                        <a class="dropdown-item waves-effect" href="javascript:void(0);">Last Month</a>
                        <a class="dropdown-item waves-effect" href="javascript:void(0);">Last Year</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-lg-4">
            <div class="row align-items-center">
                <!-- Chart Section -->
                <div class="col-md-6">
                    <div id="salesOverviewChart" style="min-height: 250px;"></div>
                </div>
                <!-- Data Summary Section -->
                <div class="col-md-6">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-light text-primary">Apparel</span>
                            <span>12%</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-info-light text-info">Electronics</span>
                            <span>25%</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-success-light text-success">FMCG</span>
                            <span>13%</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary-light text-secondary">Other Sales</span>
                            <span>50%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var chart;

        function fetchDataAndUpdateChart() {
            $.ajax({
                url: "{{ route('sales.getCategorySalesData') }}", // Backend route for data
                method: "GET",
                success: function (data) {
                    chart.updateOptions({
                        series: data.sales,
                        labels: data.categories,
                    });
                },
                error: function () {
                    console.error('Error fetching sales data');
                }
            });
        }

        // Chart options
        var options = {
            chart: {
                type: 'pie',
                height: 350,
            },
            series: [0], // Placeholder sales data
            labels: ['No Data Available'], // Placeholder labels
            colors: ['#FF5733', '#33FF57', '#3357FF', '#FFC300'], // Example color scheme
            title: {
                text: 'Sales by Category',
                align: 'center',
            },
        };

        // Initialize the chart
        chart = new ApexCharts(document.querySelector("#salesOverviewChart"), options);
        chart.render();

        // Fetch data initially and update chart every 10 seconds
        fetchDataAndUpdateChart();
        setInterval(fetchDataAndUpdateChart, 10000);
    });
</script>

    <!-- End Sell Overview -->


    <!-- Week Profit -->
    <div class="col-xxl-3 col-sm-6">
        <div class="card">
            <div class="row">
                <div class="col-6">
                    <div class="card-body">
                        <div class="card-info">
                            <h6 class="mb-4 pb-1 text-nowrap">Last Week Sales</h6>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="mb-0 me-2">BDT{{ number_format($lastWeekProfit, 2) }}</h4>

                                <!-- Display percentage change -->
                                @if ($weekPercentageChange >= 0)
                                <p class="text-success mb-0">+{{ number_format($weekPercentageChange, 2) }}%</p>
                                @else
                                <p class="text-danger mb-0">{{ number_format($weekPercentageChange, 2) }}%</p>
                                @endif
                            </div>
                            <div class="badge bg-label-secondary rounded-pill mb-xl-1">
                                {{ $startOfLastWeek->format('d F Y') }} - {{ $endOfLastWeek->format('d F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- {{-- Week Profit --}} -->


    <!-- Include ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>




    @endsection