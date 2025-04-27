<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;

class FoodController extends Controller
{
    public function menu()
    {
        $menus = DB::table('menu_items')->get();

        // All bundles joined with menu items
        $bundles = DB::table('bundles as b')
            ->join('menu_items as mi', 'mi.menu_item_id', '=', 'b.bundle_item_id')
            ->select(
                'b.bundle_id',
                'b.bundle_meal_name',
                'b.bundle_item_id',
                'b.description as bundle_description',
                'b.bundle_image',
                'b.menu_item_id',
                'mi.name as menu_name',
                'mi.price'
            )
            ->get();

    
        return view('foods.menu', compact('menus', 'bundles'));
    }

    public function order()
    {
        $cart = session()->get('cart', []);
        return view('foods.addtocart', compact('cart')); 
    }

    public function addToCart(Request $request, $menu_item_id)
    {
        $menu = Menus::findOrFail($menu_item_id);

        $bundles = DB::table('bundles as b')
            ->join('menu_items as mi', 'mi.menu_item_id', '=', 'b.bundle_item_id')
            ->where('b.bundle_item_id', $menu_item_id)
            ->select(
                'b.bundle_id',
                'b.bundle_meal_name',
                'b.bundle_item_id',
                'b.description as bundle_description',
                'b.bundle_image',
                'b.menu_item_id',
                'mi.name as menu_name',
                'mi.price'
            )
            ->get();
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
                "id" => $menu->menu_item_id,
                'sample' => $bundles
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
        $orderType = $request->query('type'); 
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
            'status' => $orderType,
            'order_date' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        session()->forget('cart'); 

        $ordersss = DB::table('order_items')
            ->where('order_id', $orderId)
            ->get();

        return view('foods.thankyou', compact('orderType','ordersss')); 
    }


    public function payment(Request $request)
    {
        $orderType = $request->query('type'); 
        return view('foods.payment', compact('orderType'));
    }

    public function thankyou()
    {
        return view('foods.thankyou', compact('ordersss'));
    }

    public function receipt(Request $request)
    {
        $orderType = $request->query('type'); 
        $ordersss = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.order_id')
            ->select('order_items.*', 'orders.total_price', 'orders.status', 'orders.order_date')
            ->get();

        return view('foods.receipt', compact('orderType', 'ordersss'));
    }
}