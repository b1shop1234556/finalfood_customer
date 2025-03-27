<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif

    <style>
        /* Custom Styles */
        body {
            background: #f5f5f5;
            font-family: 'Figtree', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-container {
            width: 100%;
            max-width: 500px;
            height: 600px; /* Set the fixed height of the card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .red-section {
            background-image: url('/poster.jpg'); /* Red section as the image background */
            background-size: cover;
            background-position: center;
            color: white;
            padding: 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        .red-section h6 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #ffffff;
        }

        .red-section h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #ffffff;
        }

        .green-section {
            background-color: #388E3C; /* Green color */
            padding: 20px;
            text-align: center;
            color: white;
        }

        .green-section img {
            width: 60px;
            margin-bottom: 10px;
        }

        .green-section h5 {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .start-btn {
            background-color: #D32F2F; /* Red color */
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 30px;
            border: none;
            margin-top: 30px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .start-btn:hover {
            background-color: #c62828;
        }

        .footer {
            background-color: #388E3C; /* Green color */
            padding: 20px;
            width: 100%;
            text-align: center;
            color: white;
        }

    </style>
</head>
<body>
    <div class="card-container">
        <div class="red-section">
            <!-- <h6>Fast & Easy</h6>
            <h1>Order <br /> & pay <br /> here</h1> -->
            <!-- <a href="{{ url('/order-as-guest') }}" class="start-btn">Order as Guest</a> -->
        </div>
        <div class="green-section">
            <a href="{{ url('/menus/create')}}" style="color: white; font: poppins; font-size: 20px; text-decoration: none;">
                <h3>Touch to start</h3>
            </a>
        </div>
    </div>
</body>
</html>
