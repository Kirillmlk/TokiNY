<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $menuId)
    {
        $product = Menu::find($menuId);

        if (!$product) {
            return redirect()->back()->with('error', 'Товар не найден.');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += 1;
        } else {

            $cart[$menuId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        Session::put('cart', $cart);

        $this->saveCartToDatabase($cart);

        return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину!');
    }

    protected function saveCartToDatabase($cart)
    {
        $userId = auth()->id();

        Cart::where('user_id', $userId)->delete();

        foreach ($cart as $menuId => $item) {
            Cart::create([
                'user_id' => $userId,
                'menu_id' => $menuId,
                'quantity' => $item['quantity']
            ]);
        }
    }

    // Просмотр корзины
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];

        if ($cart) {
            foreach ($cart as $menuId => $quantity) {
                $menu = Menu::find($menuId);

                if ($menu) {
                    $cartItems[] = (object)[
                        'menu' => $menu,
                        'quantity' => (int)$quantity,
                    ];
                }
            }
        }

        // Считаем общую сумму
        $totalPrice = array_sum(array_map(function($item) {
            return $item->menu->price * $item->quantity;
        }, $cartItems));

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }


    public function removeFromCart($menuId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$menuId])) {
            unset($cart[$menuId]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины.');
    }

    public function updateCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity');

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Корзина обновлена.');
    }

}
