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
        <h1 class="text-3xl font-bold text-gray-800">How will you make to pay?</h1>
    </div>

    <div class="mt-8 flex flex-col items-center gap-12">
        <!-- Debit and Credit -->
        <a href="{{ url('/debit-credit') }}" class="w-[30rem] p-12 bg-white shadow-lg rounded-lg text-center transform hover:scale-105 transition flex items-center gap-8">
            <img src="/card.png" alt="Debit / Credit" class="w-20 h-20">
            <h2 class="mt-4 text-2xl font-semibold text-gray-700">DEBIT / CREDIT</h2>
        </a>

        <!-- At cod -->
        <a href="{{ url('/thankyou') }}" class="w-[30rem] p-12 bg-white shadow-lg rounded-lg text-center transform hover:scale-105 transition flex items-center gap-8">
            <img src="/pay.png" alt="Debit / Credit" class="w-20 h-20">
            <h2 class="mt-4 text-2xl font-semibold text-gray-700">PAY ON COUNTER</h2>
        </a>
        
        
    </div>
    
    
    <div class="mt-8">
        <a href="{{ url('/order') }}" class="px-6 py-2 bg-red-500 text-white font-bold rounded-lg shadow-lg hover:bg-red-600 transition">Back to Order</a>
    </div>
</body>
</html>
