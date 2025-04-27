// function filterMenu(category,bundle) {
//     document.querySelectorAll('.food-card').forEach(card => {
//         card.style.display = (category === 'all' || card.dataset.category === category) ? 'block' : 'none';
//         card.style.display = (bundle === 'bundle' || card.dataset.category === bundle) ? 'block' : 'none';
//     });

//     document.querySelectorAll('.category-btn').forEach(btn => {
//         btn.classList.remove('bg-yellow-100', 'text-black'); 
//         btn.classList.add('bg-yellow-100'); 
//     });

//     const activeButton = document.querySelector(`[data-category-btn="${category}"]`);
//     if (activeButton) {
//         activeButton.classList.add('bg-yellow-100', 'text-black'); 
//         activeButton.classList.remove('bg-yellow-100'); 
//     }
// }
function filterMenu(categories = [], bundles = []) {
    document.querySelectorAll('.food-card').forEach(card => {
        const cardCategory = card.dataset.category;

        if (categories.includes(cardCategory) || bundles.includes(cardCategory)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('bg-yellow-100', 'text-black');
    });

    // Optional: highlight first category in array
    if (categories.length > 0) {
        const activeButton = document.querySelector(`[data-category-btn="${categories[0]}"]`);
        if (activeButton) {
            activeButton.classList.add('bg-yellow-100', 'text-black');
        }
    }
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('bg-yellow-100', 'text-black'); 
        btn.classList.add('bg-yellow-100'); 
    });

    const activeButton = document.querySelector(`[data-category-btn="${category}"]`);
    if (activeButton) {
        activeButton.classList.add('bg-yellow-100', 'text-black'); 
        activeButton.classList.remove('bg-yellow-100'); 
    }
}


function filterbundle(category) {
    document.querySelectorAll('.food-card').forEach(card => {
        card.style.display = (category === 'bundle' || card.dataset.category === category) ? 'block' : 'none';
    });

    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('bg-yellow-100', 'text-black'); 
        btn.classList.add('bg-yellow-100'); 
    });

    const activeButton = document.querySelector(`[data-category-btn="${category}"]`);
    if (activeButton) {
        activeButton.classList.add('bg-yellow-100', 'text-black'); 
        activeButton.classList.remove('bg-yellow-100'); 
    }
}
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
function openCustomizeModal(menuItemId, name, price, image) {
    document.getElementById(`customize-modal-${menuItemId}`).classList.remove('hidden');
}

function closeCustomizeModal(menuItemId) {
    document.getElementById(`customize-modal-${menuItemId}`).classList.add('hidden');
}
function decreaseQuantity(id) {
    const input = document.getElementById(`quantity-${id}`);
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
    }
}

function increaseQuantity(id) {
    const input = document.getElementById(`quantity-${id}`);
    input.value = parseInt(input.value) + 1;
}
function closeCustomizeModal(menuItemId) {
    const modal = document.getElementById(`customize-modal-${menuItemId}`);
    if (modal) {
        // modal.classList.add('hidden');
        modal.style.display = "none";
    }
}