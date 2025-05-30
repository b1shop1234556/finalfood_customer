<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-500 min-h-screen flex flex-col items-center justify-center text-white">
    
    <!-- Logo -->
    <div class="text-center">
        <img src="{{ asset('/jollibee.png') }}" alt="Jollibee Logo" class="w-32 h-32 mx-auto">
    </div>
    @foreach ($ordersss->take(1) as $ord)
    <!-- Thank You Message -->
    <div class="mt-6 text-center">
        <h1 class="text-4xl font-bold">Thank You</h1>
        <p class="mt-2 text-lg">Your order number is <span class="font-bold text-2xl">{{ $ord->order_id }}</span></p>
        <p class="mt-2 text-lg">Please pay at the counter.</p>
    </div>
    @endforeach

    <div class="mt-8">
        <!-- <a href="/" class="px-6 py-2 bg-red-500 text-white font-bold rounded-lg shadow-lg hover:bg-red-600 transition">TAP!</a> -->
        <form action="{{ url('/') }}">
            @csrf
            <button type="submit" class="px-6 py-2 bg-red-500 text-white font-bold rounded-lg shadow-lg hover:bg-red-600 transition">
                TAP TO ORDER!
            </button>
        </form>
    </div>

</body>
</html>
