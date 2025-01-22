<?php $__env->startSection('content'); ?>
    <!-- Include Bootstrap CSS for styling -->


    <!-- Include ApexCharts Library -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Include Icon (Optional) -->

    <div class="row g-6" style="row-gap: 2rem;">
        
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="row">
                    <!-- Profit Section -->
                    <div class="col-6">
                        <div class="card-body">
                            <div class="card-info">
                                <h6 class="mb-4 pb-1 text-nowrap">Profit</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="mb-0 me-2">BDT <?php echo e(number_format($todayProfit, 2)); ?></h4>
                                    <!-- Display percentage change -->
                                    <?php if($percentageChange >= 0): ?>
                                        <p class="text-success mb-0">+<?php echo e(number_format($percentageChange, 2)); ?>%</p>
                                    <?php else: ?>
                                        <p class="text-danger mb-0"><?php echo e(number_format($percentageChange, 2)); ?>%</p>
                                    <?php endif; ?>
                                </div>
                                <div class="badge bg-label-primary rounded-pill mb-xl-1">
                                    <?php echo e($today->format('d F Y')); ?> <!-- Display today's date -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expense Section -->
                    <div class="col-6">
                        <div class="card-body">
                            <div class="card-info">
                                <h6 class="mb-4 pb-1 text-nowrap">Expense</h6>
                                <h4 class="mb-0">BDT <?php echo e(number_format($todayExpense, 2)); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-relative">
                    
                </div>
            </div>
        </div>
        

        
        <div class="col-xxl-3 col-sm-6">
            <div class="card">
                <div class="row">
                    <!-- Profit Section -->
                    <div class="col-6">
                        <div class="card-body">
                            <div class="card-info">
                                <h6 class="mb-4 pb-1 text-nowrap">Net Profit</h6>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-0 me-2">BDT <?php echo e(number_format($netProfit, 2)); ?></h4>
                                    <!-- Display percentage change -->
                                    <?php if($percentageChange >= 0): ?>
                                        <p class="text-success mb-0">+<?php echo e(number_format($percentageChange, 2)); ?>%</p>
                                    <?php else: ?>
                                        <p class="text-danger mb-0"><?php echo e(number_format($percentageChange, 2)); ?>%</p>
                                    <?php endif; ?>
                                </div>
                                <div class="badge bg-label-primary rounded-pill mb-xl-1">
                                    <?php echo e($today->format('d F Y')); ?> <!-- Display today's date -->
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
                        <span class="h6 mb-0"><?php echo e(number_format($currentMonthProfit, 2)); ?> Profit</span>
                        <?php if($percentageProfitGrowth >= 0): ?>
                            <span class="text-success">+<?php echo e(number_format($percentageProfitGrowth, 2)); ?>%</span> this month
                        <?php else: ?>
                            <span class="text-danger"><?php echo e(number_format($percentageProfitGrowth, 2)); ?>%</span> this month
                        <?php endif; ?>
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
                                    <h5 class="mb-0"><?php echo e(number_format($currentMonthSalesCount, 0)); ?></h5>
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
                                    <h5 class="mb-0"><?php echo e(number_format($totalCustomersThisMonth, 0)); ?></h5>
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
                                    <h5 class="mb-0"><?php echo e(number_format($totalProductSalesThisMonth, 0)); ?></h5>
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
                                    <h5 class="mb-0"><?php echo e(number_format($currentMonthRevenue, 0)); ?></h5>
                                    <!-- Replaced $formattedRevenue with $currentMonthRevenue -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        
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
        


        <div class="col-xl-6">
            <div class="card h-100">
              <div class="card-header">
                <div class="d-flex justify-content-between">
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
              <div class="card-body pt-lg-5">
                <div class="row align-items-center">
                  <div class="col-md-6" style="position: relative;">
                    <div id="salesOverviewChart" style="min-height: 247.8px;"><div id="apexchartstjj4e3ih" class="apexcharts-canvas apexchartstjj4e3ih apexcharts-theme-light" style="width: 245px; height: 247.8px;"><svg id="SvgjsSvg8721" width="245" height="247.79999999999998" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG8723" class="apexcharts-inner apexcharts-graphical" transform="translate(10.5, 15)"><defs id="SvgjsDefs8722"><clipPath id="gridRectMasktjj4e3ih"><rect id="SvgjsRect8725" width="230" height="233" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMasktjj4e3ih"></clipPath><clipPath id="nonForecastMasktjj4e3ih"></clipPath><clipPath id="gridRectMarkerMasktjj4e3ih"><rect id="SvgjsRect8726" width="230" height="237" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG8727" class="apexcharts-pie"><g id="SvgjsG8728" transform="translate(0, 0) scale(1)"><circle id="SvgjsCircle8729" r="74.37073170731708" cx="113" cy="113" fill="transparent"></circle><g id="SvgjsG8730" class="apexcharts-slices"><g id="SvgjsG8731" class="apexcharts-series apexcharts-pie-series" seriesName="Apparel" rel="1" data:realIndex="0"><path id="SvgjsPath8732" d="M 113 6.756097560975604 A 106.2439024390244 106.2439024390244 0 0 1 185.7289559372041 35.55152826713004 L 163.9102691560429 58.78606978699103 A 74.37073170731708 74.37073170731708 0 0 0 113 38.62926829268292 L 113 6.756097560975604 z" fill="rgba(140,87,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="43.2" data:startAngle="0" data:strokeWidth="0" data:value="12" data:pathOrig="M 113 6.756097560975604 A 106.2439024390244 106.2439024390244 0 0 1 185.7289559372041 35.55152826713004 L 163.9102691560429 58.78606978699103 A 74.37073170731708 74.37073170731708 0 0 0 113 38.62926829268292 L 113 6.756097560975604 z"></path></g><g id="SvgjsG8733" class="apexcharts-series apexcharts-pie-series" seriesName="Electronics" rel="2" data:realIndex="1"><path id="SvgjsPath8734" d="M 185.7289559372041 35.55152826713004 A 106.2439024390244 106.2439024390244 0 0 1 190.44847173287 185.7289559372041 L 167.21393021300898 163.91026915604286 A 74.37073170731708 74.37073170731708 0 0 0 163.9102691560429 58.78606978699103 L 185.7289559372041 35.55152826713004 z" fill="#9055fdb3" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="89.99999999999999" data:startAngle="43.2" data:strokeWidth="0" data:value="25" data:pathOrig="M 185.7289559372041 35.55152826713004 A 106.2439024390244 106.2439024390244 0 0 1 190.44847173287 185.7289559372041 L 167.21393021300898 163.91026915604286 A 74.37073170731708 74.37073170731708 0 0 0 163.9102691560429 58.78606978699103 L 185.7289559372041 35.55152826713004 z"></path></g><g id="SvgjsG8735" class="apexcharts-series apexcharts-pie-series" seriesName="FMCG" rel="3" data:realIndex="2"><path id="SvgjsPath8736" d="M 190.44847173287 185.7289559372041 A 106.2439024390244 106.2439024390244 0 0 1 113 219.2439024390244 L 113 187.37073170731708 A 74.37073170731708 74.37073170731708 0 0 0 167.21393021300898 163.91026915604286 L 190.44847173287 185.7289559372041 z" fill="#9055fd80" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="46.80000000000001" data:startAngle="133.2" data:strokeWidth="0" data:value="13" data:pathOrig="M 190.44847173287 185.7289559372041 A 106.2439024390244 106.2439024390244 0 0 1 113 219.2439024390244 L 113 187.37073170731708 A 74.37073170731708 74.37073170731708 0 0 0 167.21393021300898 163.91026915604286 L 190.44847173287 185.7289559372041 z"></path></g><g id="SvgjsG8737" class="apexcharts-series apexcharts-pie-series" seriesName="OtherxSales" rel="4" data:realIndex="3"><path id="SvgjsPath8738" d="M 113 219.2439024390244 A 106.2439024390244 106.2439024390244 0 0 1 112.98145694101684 6.75609917916276 L 112.98701985871179 38.62926942541394 A 74.37073170731708 74.37073170731708 0 0 0 113 187.37073170731708 L 113 219.2439024390244 z" fill="rgba(240,242,248,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="180" data:startAngle="180" data:strokeWidth="0" data:value="50" data:pathOrig="M 113 219.2439024390244 A 106.2439024390244 106.2439024390244 0 0 1 112.98145694101684 6.75609917916276 L 112.98701985871179 38.62926942541394 A 74.37073170731708 74.37073170731708 0 0 0 113 187.37073170731708 L 113 219.2439024390244 z"></path></g></g></g><g id="SvgjsG8739" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"><text id="SvgjsText8740" font-family="Inter" x="113" y="133" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="400" fill="#6d6777" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Inter;">Weekly Vsits</text><text id="SvgjsText8741" font-family="Inter" x="113" y="109" text-anchor="middle" dominant-baseline="auto" font-size="24px" font-weight="500" fill="#433c50" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Inter;">102k</text></g></g><line id="SvgjsLine8742" x1="0" y1="0" x2="226" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine8743" x1="0" y1="0" x2="226" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG8724" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(140, 87, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(144, 85, 253, 0.7);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(144, 85, 253, 0.5);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 4;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(240, 242, 248);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                  <div class="resize-triggers"><div class="expand-trigger"><div style="width: 270px; height: 249px;"></div></div><div class="contract-trigger"></div></div></div>
                  <div class="col-md-6 mt-3 mt-md-0">
                    <div class="d-flex align-items-center">
                      <div class="avatar">
                        <div class="avatar-initial bg-label-primary rounded">
                          <i class="ri-wallet-line ri-24px"></i>
                        </div>
                      </div>
                      <div class="ms-3 d-flex flex-column">
                        <p class="mb-0">Number of Sales</p>
                        <h5 class="mb-0">$86,400</h5>
                      </div>
                    </div>
                    <hr class="my-6">
                    <div class="row g-4">
                      <div class="col-6">
                        <div class="d-flex align-items-center mb-1">
                          <div class="badge badge-dot bg-primary me-2"></div>
                          <p class="mb-0">Apparel</p>
                        </div>
                        <p class="fw-medium mb-0">$12,150</p>
                      </div>
                      <div class="col-6">
                        <div class="d-flex align-items-center mb-1">
                          <div class="badge badge-dot bg-primary me-2"></div>
                          <p class="mb-0">Electronic</p>
                        </div>
                        <p class="fw-medium mb-0">$24,900</p>
                      </div>
                      <div class="col-6">
                        <div class="d-flex align-items-center mb-1">
                          <div class="badge badge-dot bg-primary me-2"></div>
                          <p class="mb-0">FMCG</p>
                        </div>
                        <p class="fw-medium mb-0">$12,750</p>
                      </div>
                      <div class="col-6">
                        <div class="d-flex align-items-center mb-1">
                          <div class="badge badge-dot bg-primary me-2"></div>
                          <p class="mb-0">Other Sales</p>
                        </div>
                        <p class="fw-medium mb-0">$50,200</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>




       


        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


        
        <!-- Include ApexCharts -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                // Get the data passed from the controller
                const months = <?php echo json_encode($data['months'], 15, 512) ?>;
                const salesData = <?php echo json_encode($data['salesData'], 15, 512) ?>;

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

        

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                // Example data for Earning and Expense
                const months = <?php echo json_encode($data['months'], 15, 512) ?>;
                const earningData = <?php echo json_encode($data['earningData'], 15, 512) ?>; // Example earning data
                const expenseData = <?php echo json_encode($data['expenseData'], 15, 512) ?>; // Example expense data

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
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('adminBackend.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/adminDashboard.blade.php ENDPATH**/ ?>