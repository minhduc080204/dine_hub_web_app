<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="">
    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">
</head>
<style>
    .form-item {
        background-color: #e1f0f5;
        display: flex;
        padding: 7px !important;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .form-control.input {
        background-color: #e1f0f5;
        border: none !important;
    }

    .form-control.input:focus {
        outline: none !important;
        box-shadow: none !important;
        background-color: unset !important;
        border: none !important;
        background-color: #e1f0f5 !important;
    }

    .icon-login {
        background-color: #00B0B9;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .icon-login>i {
        color: white;
    }

    .form-control.button {
        background-color: #00B0B9;
        border: none !important;
        padding: 14px;
        font-size: 14px;
        font-weight: bold;
        color: white;
    }
</style>

<body>
    <div class="container w-25">
        <div class="">
            <div class="my-5">
                <h1 class="fw-bolder">Welcome Back!</h1>
                <p class="text muted">sign in to admin</p>
            </div>
            <div>
                <form action="{{ route('account.doLogin') }}" method="post">
                    @csrf
                    <div class="form-item">
                        <span class="icon-login px-1"><i class="bi bi-envelope fs-6 p-1"></i></span>
                        <input type="text" class="form-control input" name="email" placeholder="abc@gmail.com">
                    </div>
                    <div class="form-item">
                        <span class="icon-login px-1"><i class="bi bi-key fs-6 p-1"></i></span>
                        <input type="password" class="form-control input" name="password" placeholder="*******">
                    </div>
                    <div class="text-end">
                        <a href="" style="color:#00B0B9; font-size:12px;">Forgot
                            password?</a>
                    </div>
                    <div class="mt-3">
                        <button class="form-control button">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/custom.js"></script>

</body>

</html>
