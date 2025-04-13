<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;

class FoodController extends Controller
{
    public function menu()
    {
        $menus = Menus::all();  
        return view('foods.menu', compact('menus')); 
    }

    public function order()
    {
        return view('foods.addtocart'); 
    }

    public function addToCart(Request $request, $menu_item_id)
    {
        $menu = Menus::findOrFail($menu_item_id);
        $cart = session()->get('cart', []);

        $requestedQuantity = max((int)$request->input('quantity', 1), 1); 

        if (isset($cart[$menu_item_id])) {
            $cart[$menu_item_id]['quantity'] += $requestedQuantity;
        } else {
            $cart[$menu_item_id] = [
                "name" => $menu->name,
                "price" => $menu->price,
                "image" => $menu->menu_image,
                "quantity" => $requestedQuantity,
                "id" => $menu->menu_item_id
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item added to cart!');
    }


    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function clearCart(Request $request)
    {
        session()->forget('cart');

        return redirect()->route('orderview')->with('success', 'Cart has been cleared!');
    }

    public function orders(Request $request)
    {
        $orderId = random_int(100000, 999999);
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $totalPrice = 0;

        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $totalPrice += $subtotal;

            DB::table('order_items')->insert([
                'order_id' => $orderId, 
                'menu_item_id' => $item['id'],
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('orders')->insert([
            'order_id' => $orderId,
            'total_price' => $totalPrice,
            'status' => 'dine in',
            'order_date' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session()->forget('cart'); 

        $ordersss = DB::table('order_items')
            ->where('order_id', $orderId)
            ->get();

        return view('foods.thankyou', compact('ordersss')); 
    }


    public function payment()
    {
        return view('foods.payment'); 
    }

    public function thankyou()
    {
        // $orderId = session()->get('order_id'); 
        // $ordersss = DB::table('order_items')
        //     ->where('order_id', $orderId)
        //     ->get();

        return view('foods.thankyou', compact('ordersss'));
    }

    public function receipt()
    {
        return view('foods.receipt'); 
    }
}