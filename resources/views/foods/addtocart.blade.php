<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center p">

    <!-- Header -->
    <nav class="bg-blue-100 w-full p-4 shadow-md flex justify-between items-center text-white">
        <h1 class="text-2xl text-red-500 font-bold ml-2">Welcome</h1>
        <div class="flex space-x-2">
            <a href="/" class="bg-yellow-400 px-2 py-1 rounded-lg font-semibold flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h4a1 1 0 001-1v-4h2v4a1 1 0 001 1h4a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" fill="black" />
            </svg>
            </a>
        </div>
        <!-- <button class="bg-yellow-400 px-2 py-1 rounded-lg font-semibold">Order History</button>
        <button class="bg-yellow-400 px-2 py-1 rounded-lg font-semibold">Order History</button> -->
    </nav>
    <section class="max-w-6xl mx-auto mt-12 px-4">
        <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Your Cart</h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            @if (session('cart'))
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2 px-4 font-semibold text-gray-600">Item</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600">Price</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600">Quantity</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600">Total</th>
                            <th class="text-left py-2 px-4 font-semibold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach (session('cart') as $menu_item_id => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <tr class="border-b">
                                <td class="py-4 px-4 flex items-center">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                    <span>{{ $item['name'] }}</span>
                                </td>
                                <td class="py-4 px-4 text-blue-600">₱{{ number_format($item['price'], 2) }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ url('/cart/update', $menu_item_id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 px-2 py-1 text-center border rounded-md">
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                                <td class="py-4 px-4 text-blue-600">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td class="py-4 px-4">
                                    <form action="{{ url('/cart/remove', $menu_item_id) }}" method="POST">
                                        @csrf
                                        <button class="text-red-600 hover:text-red-700">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6 flex justify-end text-xl font-semibold">
                    <span class="text-gray-800">Total: </span>
                    <span class="text-blue-600">₱{{ number_format($total, 2) }}</span>
                </div>


                <div class="mt-6 flex justify-between">
                    <a href="{{ url('/menu') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-300 transition duration-300">Back</a>
                    <a href="{{ url('/payment') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-300 transition duration-300">Proceed to Checkout</a>
                </div>
            @else
                <p class="text-center text-gray-500">Your cart is empty.</p>
            @endif
            
        </div>
    </section>

</body>
</html>