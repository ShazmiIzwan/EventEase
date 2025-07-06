<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="EventEase">
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
        body, .app-form-content { background-color: #f5f7fa; }
        .app-form-sidebar { background-color: #2C3E50; }
        .sidebar-sign-logo h2,
        .sign_sidebar_text h1 { color: #ecf0f1; }
        .main-btn.btn-hover { background-color: #2980B9; border-color: #2980B9; color: #ffffff; }
        .main-btn.btn-hover:hover { background-color: #1A5276; border-color: #1A5276; }
        .form-label { color: #2C3E50; }
        .registration-title { color: #2C3E50; }
        .signup-link, .sidebar-register-link { color: #2980B9; }
        .signup-link:hover, .sidebar-register-link:hover { color: #1A5276; }
        .pass-show-eye i { color: #2C3E50; cursor: pointer; }
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
                    <h1>Join seminars, workshops, and conferences tailored for graduate scholars.</h1>
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
                                    Already have an account? <a class="sidebar-register-link" href="/">Sign In</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-7">
                            <div class="registration">
                                <form action="register-post" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <h2 class="registration-title">Sign Up for a Graduate Account</h2>

                                    @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Whoops!</strong> Please fix the errors below.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success!</strong> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group mt-4">
                                                <label class="form-label">Full Name*</label>
                                                <input class="form-control h_50" type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mt-4">
                                                <label class="form-label">University Email*</label>
                                                <input class="form-control h_50" type="email" name="email" placeholder="example@graduate.com" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mt-4">
                                                <label class="form-label">Phone Number*</label>
                                                <input class="form-control h_50" type="tel" name="phone" placeholder="e.g., +60123456789" value="{{ old('phone') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mt-4">
                                                <label class="form-label">Password*</label>
                                                <div class="loc-group position-relative">
                                                    <input class="form-control h_50" type="password" id="password" name="password"
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{8,32}"
                                                        title="8-32 chars, uppercase, lowercase, number & special"
                                                        placeholder="Create a password" required>
                                                    <span class="pass-show-eye"><i class="fas fa-eye-slash" id="togglePassword"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="main-btn btn-hover w-100 mt-4" type="submit">Sign Up</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="new-sign-link mt-3">
                                    Already have an account? <a class="signup-link" href="/login-user">Sign In</a>
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