<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Postgraduate Event Management System">
    <meta name="author" content="Your University">
    <title>EventEase</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="event-management.png">

    <!-- Stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/night-mode.css" rel="stylesheet">

    <!-- Vendor Stylesheets -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

    <style>
        body, .app-form-content {
            background-color: #f5f7fa;
        }
        .app-form-sidebar {
            background-color: #2C3E50;
        }
        .sidebar-sign-logo h2,
        .sign_sidebar_text h1 {
            color: #ecf0f1;
        }
        .main-btn.btn-hover {
            background-color: #2980B9;
            border-color: #2980B9;
            color: #ffffff;
        }
        .main-btn.btn-hover:hover {
            background-color: #1A5276;
            border-color: #1A5276;
            color: #ffffff;
        }
        .form-label {
            color: #2C3E50;
        }
        .registration-title {
            color: #2C3E50;
        }
        .signup-link, .sidebar-register-link {
            color: #2980B9;
        }
        .signup-link:hover, .sidebar-register-link:hover {
            color: #1A5276;
        }
        .pass-show-eye i {
            color: #2C3E50;
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
        <div class="app-form">
            <div class="app-form-sidebar">
                <div class="sidebar-sign-logo">
                    <h2>EventEase</h2>
                </div>
                <div class="sign_sidebar_text">
                    <h1>Seamlessly register for research seminars, workshops, and conferences designed for Postgraduate Students.</h1>
                </div>
            </div>
            <div class="app-form-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-10">
                            <div class="app-top-items">
                                <a href="/">
                                    <div class="sign-logo" id="logo">
                                        <img src="event-management.png" alt="Portal Logo">
                                        <img class="logo-inverse" src="event-management.png" alt="Portal Logo">
                                    </div>
                                </a>
                                <div class="app-top-right-link">
                                    New to the EventEase? <a class="sidebar-register-link" href="/register-user">Sign up</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-6 col-md-7">
                            <div class="registration">
                                <form action="login-user" method="POST" autocomplete="off">
                                    @csrf
                                    <h2 class="registration-title">Sign in to Your Student Account</h2>

                                    @if($message = Session::get('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Whoops!</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    @if($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Great!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <div class="form-group mt-5">
                                        <label class="form-label">University Email*</label>
                                        <input class="form-control h_50" name="email" type="email" placeholder="Enter your university email" required>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="form-label">Password*</label>
                                        <div class="loc-group position-relative">
                                            <input class="form-control h_50" type="password" placeholder="Enter your password" id="password" name="password" required>
                                            <span class="pass-show-eye"><i class="fas fa-eye-slash" id="togglePassword"></i></span>
                                        </div>
                                    </div>
                                    <button class="main-btn btn-hover w-100 mt-4" type="submit">Sign In <i class="fas fa-sign-in-alt ms-2"></i></button>
                                </form>
                                <div class="new-sign-link mt-3">
                                    Don't have an account? <a class="signup-link" href="/register-user">Register here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-footer text-center mt-4" style="color:#7f8c8d;">
                    © 2025, EventEase. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/night-mode.js"></script>

    <script>
        $(document).ready(function () {
            $('#togglePassword').on('click', function () {
                const pwd = $('#password');
                const type = pwd.attr('type') === 'password' ? 'text' : 'password';
                pwd.attr('type', type);
                $(this).toggleClass('fa-eye-slash fa-eye');
            });
        });
    </script>
</body>
</html>