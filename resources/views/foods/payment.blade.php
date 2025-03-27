<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center p">
    
    <img src="/poster.jpg" alt="Food Item" class="w-full h-80 object-cover">
    
    <div class="mt-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Select Payment Type</h1>
    </div>

    <div class="mt-8 flex flex-wrap justify-center gap-6">
        <!-- Pay gcash -->
        <a href="{{ url('/payment') }}" class="w-64 p-4 bg-white shadow-lg rounded-lg text-center transform hover:scale-105 transition">
            <img src="/gcashs.png" alt="Pay Here" class="w-24 mx-auto">
            <h2 class="mt-3 text-lg font-semibold text-gray-700">PAY ON GCASH</h2>
        </a>
        
        <!-- At cod -->
        <a href="{{ url('/complete') }}" class="w-64 p-4 bg-white shadow-lg rounded-lg text-center transform hover:scale-105 transition">
            <img src="/cod.png" alt="At Counter" class="w-24 mx-auto">
            <h2 class="mt-3 text-lg font-semibold text-gray-700">CASH ON DELIVER</h2>
        </a>
    </div>
    
    <div class="mt-8">
        <a href="{{ url('/order') }}" class="px-6 py-2 bg-red-500 text-white font-bold rounded-lg shadow-lg hover:bg-red-600 transition">Back to Order</a>
    </div>
</body>
</html>
