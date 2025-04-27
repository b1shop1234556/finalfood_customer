<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jollibee</title>
    <link rel="icon" href="/jollibee.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<!-- <body class="bg-gray-100 min-h-screen flex flex-col items-center p"> -->
<body class="">
    <nav class="sticky top-0 bg-blue-100 w-full p-4 shadow-md flex justify-between items-center text-white z-50" style="background-image: url('/jolli.png'); background-size: cover; background-position: center; border: 2px solid #ccc;">
        <img class="h-16 w-auto">
    </nav>
    <div class="fixed justify-center items-center sticky top-0 bg-white z-10" style="margin-bottom: 40px;" >
        <h2 class="text-2xl font-bold p-5 bg-white text-center z-20 " style="position: fixed; top: 0; width: 100%; padding-top: 14%; margin-bottom: 100px;">Your Order</h2>
    </div>
    <div id="order-summary" style="padding: 10px; border-radius: 1px; padding-top: 6vh">
        <div id="order-details" class="space-y-4 max-h-50 overflow-y-auto" style="padding: 8px; border-radius: 1px; margin-bottom: 100px;">
            @if(session('cart') && count(session('cart')) > 0)
            @php $total = 0; @endphp
            @foreach(session('cart') as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="flex items-center rounded-lg" style="border: 1px solid #ddd; padding: 8px; margin-bottom: 8px;">
                    <div class="flex-2 p-3 rounded-lg">
                        <form action="{{ url('/cart/update', $item['id']) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 px-2 py-1 text-center border rounded-md focus:ring-2 focus:ring-blue-400">
                            <!-- <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">
                                {{ session('edit_item_id') == $item['id'] ? 'Save' : 'Update' }}
                            </button> -->
                       
                    </div>
                    <div class="flex justify-between items-center bg-yellow-100 p-2 rounded-lg flex-1">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-12 w-12 rounded-md mr-2">
                        <div class="flex-1">
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            @foreach($item['sample'] as $bundle)
                                <div class="flex flex-col">
                                    <p class="mx-4">x1 {{ $bundle->bundle_meal_name ?? 'N/A' }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-black font-bold">
                            ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                        </div>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg">
                        <div class="flex space-x-2">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-red-700">
                                    <i class="fa fa-pencil">{{ session('edit_item_id') == $item['id'] ? 'Save' : ' ' }}</i>
                                </button>
                            </form>
                            <form action="{{ url('/cart/remove', $item['id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-red-700">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
            <p class="text-gray-500 text-center">Your cart is empty.</p>
            @endif
        </div>
    </div>
    <footer id="order-actions" class="fixed bottom-0 left-0 w-full bg-white flex justify-between items-center" style="border-top: 1px solid #ddd; padding: 8px;">
        <form action="{{ url('/menu') }}">
            @csrf
            <button type="submit" class="bg-red-500 px-4 py-2 rounded-lg font-semibold text-white hover:bg-red-700">
                Back
            </button>
        </form>
        <a href="{{ url('/dine') }}" class="bg-green-500 px-4 py-2 rounded-lg font-semibold text-white hover:bg-green-700">
            Process Your Order
        </a>
        @if(session('cart') && count(session('cart')) > 0)
        <div class="bg-red-500 px-4 py-2 rounded-lg font-semibold text-white">
            <span class="text-sm">Order Total</span> <br><span class="text-lg">₱ {{ number_format($total, 2) }}</span>
        </div>
        @endif
    </footer>
</body>
</html>
 <!-- <section class="max-w-6xl mx-auto mt-12 px-4">
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
    </section> -->