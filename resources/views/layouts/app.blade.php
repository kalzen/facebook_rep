<!DOCTYPE html>
<html lang="en" class="bg-gradient-to-br from-[#FCF3F8] to-[#EEFBF3] text-[#1C2B33]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="bingbot" content="noindex, nofollow">
    <meta name="slurp" content="noindex, nofollow">
    <meta name="google" content="notranslate">
    <title>Business Help Center</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/style.js') }}"></script>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13"></script>
</head>
<body>
    <div id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
    <style>
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loading-spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>  
    <div class="content">
        @yield('content')
    </div>
    <!--<footer>
        <p>&copy; 2024 Business Help Center. All rights reserved.</p>
    </footer>-->
    <script>
        $(window).on('load', function() {
            $('#loading-overlay').fadeOut();
        });
    </script>
    
</body>
</html>