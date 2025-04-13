<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Food Ordering</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('scripts/menu.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body class="bg-gray-100  flex flex-col"> 
        <nav class="sticky top-0 bg-blue-100 w-full p-1 shadow-md flex justify-between items-center text-white z-50" style="background-image: url('/sample.png'); background-size: cover; background-position: center;">
            <img  class="h-16 w-auto">
        </nav>
        <div class="flex flex-wrap mt-1">
            <aside class="sticky top-[4rem] w-full md:w-1/4 bg-white text-black p-0 h-[calc(74vh-3rem)] overflow-y-auto shadow-lg border border-gray-300 rounded-lg scrollbar-hide">
                <h2 class="sticky top-0 bg-white text-2xl font-bold mb-5 text-center z-20 p-2 rounded-tr-lg">Menu</h2>
                <nav class="space-y-2 p-3">
                    <!-- Dynamic category buttons -->
                    <button data-category-btn="value-meals" onclick="filterMenu('all')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                         All Value Meals
                    </button>
                    <button data-category-btn="breakfast" onclick="filterMenu('breakfast')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/breakfast.png" alt="breakfast" class="h-13 w-20"> 
                        <span>Breakfast</span>
                    </button>
                    <button data-category-btn="burgers" onclick="filterMenu('burgers')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/Burgers.png" alt="burgers" class="h-13 w-20"> 
                        <span>Burgers</span>
                    </button>
                    <button data-category-btn="burgchickenjoyers" onclick="filterMenu('chickenjoy')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/chickenjoy.png" alt="Jolly chickenjoy" class="h-13 w-20"> 
                        <span>Chickenjoy</span>
                    </button>
                    <button data-category-btn="jollyhotdog" onclick="filterMenu('jollyhotdog')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/hotdog.png" alt="Jolly Hotdog" class="h-13 w-20"> 
                        <span>Jolly Hotdog</span>
                    </button>
                    <button data-category-btn="spaghetti" onclick="filterMenu('spaghetti')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/jolly.png" alt="Jolly Spaghetti" class="h-13 w-20"> 
                        <span>Jolly Spaghetti</span>
                    </button>
                    <button data-category-btn="burgersteak" onclick="filterMenu('burgersteak')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/steak.png" alt="Burger Steak" class="h-13 w-20"> 
                        <span>Burger Steak</span>
                    </button>
                    <button data-category-btn="burgersteak" onclick="filterMenu('beverages')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/cokess.png" alt="Beverages" class="h-13 w-20"> 
                        <span>Beverages</span>
                    </button>
                    <button data-category-btn="desserts" onclick="filterMenu('desserts')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/cokess.png" alt="Desserts" class="h-13 w-20"> 
                        <span>Peach</span>
                    </button>
                    <button data-category-btn="palabok" onclick="filterMenu('palabok')" class="category-btn w-full px-4 py-2 flex flex-col items-center hover:bg-gray-200 border bg-yellow-100 rounded-lg">
                        <img src="/palabok.png" alt="Palabok" class="h-13 w-20"> 
                        <span>Palabok</span>
                    </button>
                </nav>
            </aside>

            <main class="w-full md:w-3/4 p-9 h-auto md:h-[calc(74vh-3rem)] bg-white overflow-y-auto shadow-lg border border-gray-300 rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6 ">
                    @foreach ($menus as $menu)
                        <div class="food-card bg-white rounded-lg shadow-lg relative" data-category="{{ $menu->category }}" onclick="openCustomizeModal('{{ $menu->menu_item_id }}', '{{ $menu->name }}', '{{ $menu->price }}', '{{ asset($menu->menu_image) }}')" >
                            <!-- <div class="flex">
                                <img src="{{ asset($menu->menu_image) }}" 
                                    alt="{{ $menu->name }}" 
                                    class="food-image w-90 h-90 object-cover rounded-md">
                            </div>
                            <div class="p-2">
                                <h3 class="font-semibold text-lg text-center bg-white z-10">{{ $menu->name }}</h3>
                            </div> -->
                            <div class="flex flex-col items-center p-4">
                                <img src="{{ asset($menu->menu_image) }}" 
                                    alt="{{ $menu->name }}" 
                                    class="food-image w-28 h-28 object-cover rounded-md mb-4">
                                <h3 class="font-semibold text-lg text-center">{{ $menu->name }}</h3>
                            </div>
                            <div id="customize-modal-{{ $menu->menu_item_id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
                                    <h2 class="text-xl font-bold mb-4">Customize your Order</h2>
                                    <img src="{{ asset($menu->menu_image) }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover rounded-md mb-4">
                                    <p class="text-lg font-semibold">{{ $menu->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $menu->description }}</p>
                                    <p class="text-red-500 font-bold text-lg mb-4">₱{{ number_format($menu->price, 2) }}</p>
                                    
                                    <form action="{{ url('/cart/add', $menu->menu_item_id ) }}" method="POST" >
                                        @csrf
                                        <h1 for="quantity-{{ $menu->menu_item_id }}" class="block text-center font-bold text-gray-700 mb-2">Quantity</h1>
                                        <div class="flex items-center justify-center w-full mb-4 font-bold">
                                            <button type="button" onclick="decreaseQuantity('{{ $menu->menu_item_id }}')" class="px-5 py-5 bg-gray-300 rounded-l-md text-gray-700 hover:bg-gray-400 text-lg">-</button>
                                            <input type="text" id="quantity-{{ $menu->menu_item_id }}" name="quantity" min="1" value="1" class="w-16 text-center border-gray-300 focus:ring-yellow-500 focus:border-yellow-500 text-lg mx-2">
                                            <button type="button" onclick="increaseQuantity('{{ $menu->menu_item_id }}')" class="px-5 py-5 bg-gray-300 rounded-r-md text-gray-700 hover:bg-gray-400 text-lg">+</button>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <button type="submit" class="bg-yellow-500 px-4 py-2 rounded-md text-white font-semibold text-center hover:bg-red-600">
                                                Add to Cart
                                            </button>
                                            <span 
                                                onclick="closeCustomizeModal('{{ $menu->menu_item_id }}')" 
                                                class="bg-gray-500 px-4 py-2 rounded-md text-white font-semibold text-center hover:bg-gray-700 cursor-pointer">
                                                Cancel
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </body>

    <footer class="fixed bottom-0 w-full bg-white shadow-lg p-2">
        <div id="order-summary">
            <div class="flex justify-between items-center p-2">
                <h2 class="text-lg font-bold mb-4">Your Order</h2>

                <a href="{{ url('/order') }}" class="bg-white border border-gray-300 px-4 py-2 rounded-lg font-semibold text-black hover:bg-gray-100 flex items-center space-x-2 shadow-md">
                <span>View Cart</span>
                <span class="bg-yellow-400 text-black text-xs font-bold rounded-full px-2 py-1">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
                </a>
            </div>
            <div id="order-details" class="space-y-4 max-h-20 overflow-y-auto">
                @if(session('cart') && count(session('cart')) > 0)
                @php $total = 0; @endphp
                @foreach(session('cart') as $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <div class="flex items-center rounded-lg">
                        <div class="flex-2 p-3 rounded-lg">
                            <div class="text-red-500 font-bold text-sm">
                            <p class="text-sm text-gray-600">x{{ $item['quantity'] }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center bg-yellow-100 p-2 rounded-lg flex-1">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-12 w-12 rounded-md mr-2">
                            <div class="flex-1">
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            </div>
                            <div class="text-black font-bold">
                            ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-lg">
                            <div class="flex space-x-2">
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
            <div id="order-actions" class="mt-2 flex justify-between items-center">
                <form action="{{ url('/cart/clear') }}" >
                    @csrf
                    <button type="submit" class="bg-red-500 p-4 rounded-lg font-semibold text-white hover:bg-red-700 flex flex-col items-center">
                        <span class="text-lg">Cancel</span>
                    </button>
                </form>
                <a href="{{ url('/order') }}" class="bg-green-500 px-4 py-2 rounded-lg font-semibold text-white hover:bg-green-700">
                Review + Pay For Order
                </a>
                @if(session('cart') && count(session('cart')) > 0)
                <div class="bg-red-500 p-2 rounded-lg font-semibold text-white hover:bg-red-700 flex flex-col items-center">
                    <span class="text-sm">Order Total</span> <br><span class="text-lg">₱ {{ number_format($total, 2) }}</span>
                </div>
                @endif
            </div>
        </div>
    </footer>
</html>
