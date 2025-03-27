<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function filterMenu(category) {
            document.querySelectorAll('.food-card').forEach(card => {
                card.style.display = (category === 'all' || card.dataset.category === category) ? 'block' : 'none';
            });

            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('bg-yellow-900', 'text-white'); // Remove highlight
                btn.classList.add('bg-yellow-700'); // Reset default color
            });

            const activeButton = document.querySelector(`[data-category-btn="${category}"]`);
            if (activeButton) {
                activeButton.classList.add('bg-yellow-900', 'text-white'); // Highlight selection
                activeButton.classList.remove('bg-yellow-700'); // Remove default color
            }
        }
    </script>

</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    
     <!-- Header -->
     <nav class="bg-blue-100 w-full p-4 shadow-md flex justify-between items-center text-white">
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
    
    <div class="flex flex-1">
        <!-- Sidebar Navigation -->
        <!-- Sidebar Navigation -->
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

        <main class="flex-1 p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($menus as $menu)
                <div class="food-card bg-white p-4 rounded-lg shadow-lg relative" data-category="{{ $menu->category }}">
                <img src="{{ asset($menu->menu_image) }}" 
                    alt="{{ $menu->name }}" 
                    class="food-image w-full h-40 object-cover rounded-md mb-4">

                <h3 class="font-semibold text-lg">{{ $menu->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $menu->description }}</p>
                <p class="text-red-500 font-bold text-lg">₱{{ number_format($menu->price, 2) }}</p>

                <form action="{{ url('/cart/add', $menu->menu_item_id ) }}" method="POST" onsubmit="return checkDuplicateOrder(event, '{{ $menu->menu_item_id }}')">
                    @csrf
                    <button type="submit"
                        onclick="addToCart(event, '{{ asset($menu->menu_image) }}')" 
                        @click.prevent="
                        showFlyImage = true;
                        setTimeout(() => showFlyImage = false, 700);
                        $event.target.closest('.food-card').querySelector('form').submit();
                        "
                        class="block bg-yellow-500 mt-4 px-4 py-2 rounded-md text-white font-semibold text-center hover:bg-red-600">
                    Add to Cart
                    </button>
                </form>

                </div>
            @endforeach
            </div>
        </main>

        <script>
            function checkDuplicateOrder(event, menuItemId) {
                const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
                if (cartItems.includes(menuItemId)) {
                    showModal('This item is already in your cart.');
                    event.preventDefault();
                    return false;
                }
                cartItems.push(menuItemId);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            return true;
            }
        </script>
    </div>

    <script>
        function addToCart(event, imageUrl) {
            let cartIcon = document.getElementById('order-history');

            let floatingImage = document.createElement('img');
            floatingImage.src = imageUrl;
            floatingImage.className = 'floating-img';
            floatingImage.style.position = 'fixed';
            floatingImage.style.width = '200px';
            floatingImage.style.height = '200px';
            floatingImage.style.borderRadius = '50%';
            floatingImage.style.zIndex = '1000';
            floatingImage.style.transition = 'all 0.7s ease-in-out';

            document.body.appendChild(floatingImage);

            let rect = event.target.getBoundingClientRect();
            floatingImage.style.left = `${rect.left + window.scrollX}px`;
            floatingImage.style.top = `${rect.top + window.scrollY}px`;

            let cartRect = cartIcon.getBoundingClientRect();
            
            setTimeout(() => {
                floatingImage.style.transform = `translate(${cartRect.left - rect.left}px, ${cartRect.top - rect.top}px) scale(0.3)`;
                floatingImage.style.opacity = '0';
            }, 100);

            setTimeout(() => document.body.removeChild(floatingImage), 700);

            // Send AJAX request to Laravel to add item to cart
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ menu_item_id: event.target.getAttribute('data-id') })
            }).then(response => response.json())
            .then(data => console.log('Item added:', data));
        }
    </script>
    
   
</body>
</html>
