<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        if (isset($cart[$menu_item_id])) {
            $cart[$menu_item_id]['quantity'] += 1;
        } else {
            $cart[$menu_item_id] = [
                "name" => $menu->name,
                "price" => $menu->price,
                "image" => $menu->menu_image, 
                "quantity" => 1
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

    public function payment()
    {
        return view('foods.payment'); 
    }

    public function thankyou()
    {
        return view('foods.thankyou'); 
    }
}