<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center p">

    <nav class="sticky top-0 bg-blue-100 w-full p-4 shadow-md flex justify-between items-center text-white z-50" style="background-image: url('/sample.png'); background-size: cover; background-position: center;">
        <img  class="h-16 w-auto">
    </nav>
    <section class="max-w-6xl mx-auto mt-12 px-4">
        <h2 class="text-4xl font-bold mb-8 text-center text-gray-800">Your Cart</h2>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            @if (session('cart'))
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Item</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Price</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Quantity</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Total</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50">
                        @php $total = 0; @endphp
                        @foreach (session('cart') as $menu_item_id => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <tr class="border-b hover:bg-gray-100 transition">
                                <td class="py-4 px-4 flex items-center">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-md mr-4 shadow-md">
                                    <span class="font-medium text-gray-800">{{ $item['name'] }}</span>
                                </td>
                                <td class="py-4 px-4 text-blue-600 font-semibold">₱{{ number_format($item['price'], 2) }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ url('/cart/update', $menu_item_id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 px-2 py-1 text-center border rounded-md focus:ring-2 focus:ring-blue-400">
                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">Update</button>
                                    </form>
                                </td>
                                <td class="py-4 px-4 text-blue-600 font-semibold">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ url('/cart/remove', $menu_item_id) }}" method="POST">
                                        @csrf
                                        <button class="text-red-500 hover:text-red-600 font-semibold">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-8 flex justify-between items-center text-xl font-semibold">
                    <span class="text-gray-800">Total:</span>
                    <span class="text-blue-600">₱{{ number_format($total, 2) }}</span>
                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ url('/menu') }}" class="bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">Back</a>
                    <a href="{{ url('/dine') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition duration-300">Proceed to Checkout</a>
                </div>
            @else
                <p class="text-center text-gray-500 text-lg">Your cart is empty.</p>
                <div class="mt-8 flex justify-center">
                    <a href="{{ url('/menu') }}" class="bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">Back</a>
                </div>
            @endif
        </div>
    </section>

</body>
</html>