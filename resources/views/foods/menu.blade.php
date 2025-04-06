<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Food Ordering</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('scripts/menu.js') }}"></script>
    </head>
    <body class="bg-gray-100  flex flex-col"> 
        <!-- Header -->
        <nav class="sticky top-0 bg-blue-100 w-full p-4 shadow-md flex justify-between items-center text-white z-50">
            <h1 class="text-2xl text-red-500 font-bold ml-2">Welcome</h1>
            <div class="flex space-x-2">
                <a id="order-history" href="{{ url('/order') }}" class="bg-red-500 px-2 py-1 rounded-lg font-semibold flex items-center relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4h-2l-1 2h-2v2h2l3.6 7.59-1.35 2.44c-.16.29-.25.63-.25.97 0 1.1.9 2 2 2h12v-2h-12l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.3.12-.47 0-.55-.45-1-1-1h-14.31l-.94-2zm3 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                    <span id="cart-count" class="absolute top-0 right-0 bg-yellow-400 text-black text-xs font-bold px-2 py-1 rounded-full transform translate-x-1/2 -translate-y-1/2">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
                <a href="/" class="bg-yellow-400 px-2 py-1 rounded-lg font-semibold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h4a1 1 0 001-1v-4h2v4a1 1 0 001 1h4a1 1 0 001-1v-6.586l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" fill="black" />
                </svg>
                </a>
            </div>
        </nav>

        <div class="flex flex-wrap">
            <aside class="sticky top-[4rem] w-full md:w-1/4 bg-white text-black p-5 h-[calc(100vh-4rem)] overflow-y-auto shadow-lg border border-gray-300 rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Menu</h2>
                <nav class="space-y-2">
                    <!-- Dynamic category buttons -->
                    <button data-category-btn="value-meals" onclick="filterMenu('all')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                         All Value Meals
                    </button>
                    <button data-category-btn="breakfast" onclick="filterMenu('breakfast')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/breakfast.png" alt="breakfast" class="h-8 w-8 mr-2"> Breakfast
                    </button>
                    <button data-category-btn="burgers" onclick="filterMenu('burgers')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/Burgers.png" alt="burgers" class="h-8 w-8 mr-2"> Burgers
                    </button>
                    <button data-category-btn="chickenjoy" onclick="filterMenu('chickenjoy')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/chickenjoy.png" alt="Jolly chickenjoy" class="h-8 w-8 mr-2"> Chickenjoy
                    </button>
                    <button data-category-btn="jollyhotdog" onclick="filterMenu('jollyhotdog')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/hotdog.png" alt="Jolly Hotdog" class="h-8 w-8 mr-2"> Jolly Hotdog
                    </button>
                    <button data-category-btn="spaghetti" onclick="filterMenu('spaghetti')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/jolly.png" alt="Jolly Spaghetti" class="h-8 w-8 mr-2"> Jolly Spaghetti
                    </button>
                    <button data-category-btn="burgersteak" onclick="filterMenu('burgersteak')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/steak.png" alt="Burger Steak" class="h-8 w-8 mr-2"> Burger Steak
                    </button>
                    <button data-category-btn="beverages" onclick="filterMenu('beverages')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/cokess.png" alt="Burger Steak" class="h-8 w-8 mr-2"> Beverages
                    </button>
                    <button data-category-btn="desserts" onclick="filterMenu('desserts')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/Peach.png" alt="Desserts" class="h-8 w-8 mr-2"> Desserts
                    </button>
                    <button data-category-btn="palabok" onclick="filterMenu('palabok')" class="category-btn w-full px-4 py-2 flex items-center hover:bg-gray-200 border border-gray-300 rounded-lg">
                        <img src="/palabok.png" alt="Palabok" class="h-8 w-8 mr-2"> Palabok
                    </button>
                </nav>
            </aside>
            <main class="w-full md:w-3/4 p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($menus as $menu)
                        <div class="food-card bg-white p-4 rounded-lg shadow-lg relative" data-category="{{ $menu->category }}" onclick="openCustomizeModal('{{ $menu->menu_item_id }}', '{{ $menu->name }}', '{{ $menu->price }}', '{{ asset($menu->menu_image) }}')" >
                            <img src="{{ asset($menu->menu_image) }}" 
                                alt="{{ $menu->name }}" 
                                class="food-image w-full h-40 object-cover rounded-md mb-4">

                            <h3 class="font-semibold text-lg text-center">{{ $menu->name }}</h3>
                            <p class="text-red-500 font-bold text-center text-lg">₱{{ number_format($menu->price, 2) }}</p>
                            <div id="customize-modal-{{ $menu->menu_item_id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
                                    <button 
                                        onclick="closeCustomizeModal('{{ $menu->menu_item_id }}')" 
                                        class="absolute top-2 right-2 bg-gray-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-700">
                                        &times;
                                    </button>
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
                                                Order Now
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
                        <script>
                            function closeCustomizeModal(menuItemId) {
                                const modal = document.getElementById(`customize-modal-${menuItemId}`);
                                if (modal) {
                                    modal.classList.add('hidden');
                                }
                            }
                        </script>
                    @endforeach
<script>
    function closeCustomizeModal(menuItemId) {
        const modal = document.getElementById(`customize-modal-${menuItemId}`);
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>
                    <!-- @foreach ($menus as $menu)
                    <div class="food-card bg-white p-4 rounded-lg shadow-lg relative" data-category="{{ $menu->category }}">
                            <img src="{{ asset($menu->menu_image) }}" 
                                alt="{{ $menu->name }}" 
                                class="food-image w-60 h-60  rounded-md mb-4">

                            <h3 class="font-semibold text-lg">{{ $menu->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $menu->description }}</p>
                            <p class="text-red-500 font-bold text-lg">₱{{ number_format($menu->price, 2) }}</p>
                            <button 
                                onclick="openCustomizeModal('{{ $menu->menu_item_id }}', '{{ $menu->name }}', '{{ $menu->price }}', '{{ asset($menu->menu_image) }}')" 
                                class="block bg-yellow-500 mt-4 px-4 py-2 rounded-md text-white font-semibold text-center hover:bg-red-600 mx-auto">
                                Add to Cart
                            </button>

                            <div id="customize-modal-{{ $menu->menu_item_id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
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
                                                Order Now
                                            </button>
                                            <span 
                                                onclick="closeCustomizeModal('{{ $menu->menu_item_id }}')" 
                                                class="bg-gray-500 px-4 py-2 rounded-md text-white font-semibold text-center hover:bg-gray-700">
                                                Cancel
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach -->
                </div>
            </main>
        </div>
        <!-- Order Summary Section -->
        <div class="fixed bottom-0 w-full bg-white shadow-lg p-4">
            <h2 class="text-lg font-bold mb-4">Your Order</h2>
            <div class="space-y-4 max-h-32 overflow-y-auto">
                @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $item)
            <div class="flex justify-between items-center bg-yellow-100 p-2 rounded-lg">
            <div class="flex items-center">
            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="h-12 w-12 rounded-md mr-2">
            <div>
            <p class="font-semibold">{{ $item['name'] }}</p>
            <p class="text-sm text-gray-600">x{{ $item['quantity'] }}</p>
            </div>
            </div>
            <div class="text-red-500 font-bold">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
            </div>
            @endforeach
            @else
            <p class="text-gray-500 text-center">Your cart is empty.</p>
            @endif
            </div>
            <div class="mt-4 flex justify-between items-center">
            <form action="{{ url('/cart/reset') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 px-4 py-2 rounded-lg font-semibold text-white hover:bg-red-700">
                Cancel
            </button>
            </form>
            <button class="bg-green-500 px-4 py-2 rounded-lg font-semibold text-white hover:bg-green-700">
            Review + Pay For Order
            </button>
            <div class="text-lg font-bold">
            Order Total: <span class="text-yellow-400">₱{{ session('cart_total', '0.00') }}</span>
            </div>
            </div>
        </div>
        </div>
        </body>
</html>
