<!doctype html>
<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    @include('adminBackend.components.head_css');
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Navigation -->
            @include('adminBackend.components.sidebar')

            <!-- Layout container -->
            <div class="layout-page">

                @include('adminBackend.components.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                                        <!-- Content -->

                                        <div class="container-xxl flex-grow-1 container-p-y">
                                        </div>

                    @include('adminBackend.components.footer')
                    <div class="content-backdrop fade"></div>
                </div>


            </div>

        </div>
    </div>
    @include('adminBackend.components.scripts')
</body>

</html>
