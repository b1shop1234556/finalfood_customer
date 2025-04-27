<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-red-500 min-h-screen flex flex-col items-center justify-center text-white">
        <div class="bg-white text-black p-6 rounded-lg shadow-lg w-100 max-w-md mx-auto mt-8">
            <h2 class="text-center text-xl font-bold mb-2">Jollibee</h2>
            <p class="text-center text-sm mb-1">1/F, Rosario Commercial Market</p>
            <p class="text-center text-sm mb-1">Jollibee POS Terminal 3</p>
            <p class="text-center text-sm mb-4">DATE: {{ now()->setTimezone('Asia/Manila')->format('d-m-Y') }} TIME: {{ now()->setTimezone('Asia/Manila')->format('h:i A') }}</p>
            <p class="text-center text-sm mb-4">Order No.</p>
            <div class="flex justify-center mt-4">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Receipt%20Details" alt="QR Code" class="w-20 h-20">
            </div>
            <br><br>
            ======================================
            <div class="text-center font-bold">
                <p class="text-2xl">{{ ucfirst($orderType) }}</p>
            </div>
            ======================================
            <br><br>
            <table class="w-full text-left border-collapse mb-4">
            <thead>
                <tr class="text-center">
                <th class="py-1 font-bold">ITEM</th>
                <th class="py-1 font-bold text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach (session('cart') as $menu_item_id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <tr>
                    <td class="py-1 px-3">
                    <span class="block font-bold">{{ $item['name'] ?? 'N/A' }}</span>
                    @if (!empty($item['name']))
                        <span class="text-sm px-2">x{{ $item['quantity'] }}</span> <span class="text-sm">{{ $item['name'] }}</span>
                        @foreach($item['sample'] as $bundle)
                            <div class="flex flex-col">
                                <p class="mx-4">x1 {{ $bundle->bundle_meal_name ?? 'N/A' }}</p>
                            </div>
                        @endforeach
                    @endif
                    </td>
                    <td class="py-1 text-right align-top">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <div class="border-t border-black mt-2 pt-2">
                <p class="text-right font-bold">Total: ₱{{ number_format($total, 2) }}</p>
            </div>
            <!-- <div class="mt-4">
                <p class="text-sm">Dine In</p>
                <p class="text-sm">Cash: ₱500.00</p>
                <p class="text-sm">Change: ₱{{ number_format(500 - $total, 2) }}</p>
            </div> -->
        </div>
        <div class="mt-8">
            <a href="{{ url('/orders?type=' . $orderType) }}" class="px-6 py-2 bg-red-500 text-white font-bold rounded-lg shadow-lg hover:bg-red-600 transition">
                Process Order
            </a>
        </div>
    </body>
</html>
