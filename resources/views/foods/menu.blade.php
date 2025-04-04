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
            <aside class="w-64 bg-yellow-600 text-white p-6 min-h-screen mt-1">
                <h2 class="text-2xl font-bold mb-4">Categories</h2>
                <nav class="space-y-2">
                    <!-- Dynamic category buttons -->
                    <button data-category-btn="all" onclick="filterMenu('all')" class="category-btn w-full px-4 py-2 bg-yellow-700 rounded-lg flex items-center">
                        <img src="/remove.png" alt="All" class="h-10 w-15 mr-2"> All
                    </button>
                    @foreach($categories as $category)
                        <button data-category-btn="{{ strtolower($category->category) }}" onclick="filterMenu('{{ strtolower($category->category) }}')" class="category-btn w-full px-4 py-2 bg-yellow-700 rounded-lg flex items-center">
                            <img src="/{{ strtolower($category->category) }}.png" alt="{{ $category->category }}" class="h-10 w-15 mr-2"> {{ ucfirst($category->category) }}
                        </button>
                    @endforeach
                </nav>
            </aside>
            
            <main class="w-full md:w-3/4 p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($menus as $menu)
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

                            <!-- Modal -->
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
                    @endforeach
                </div>
            </main>
        </div>
    </body>
</html>
