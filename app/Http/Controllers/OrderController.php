<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function createOrder()
    {
        // Получаем ID текущего пользователя
        $userId = auth()->id();

        // Получаем корзину из базы данных
        $userCart = Cart::where('user_id', $userId)->first();
        $cartItems = $userCart ? $this->getCartItems(json_decode($userCart->items, true)) : [];
        $totalPrice = $this->totalPrice($cartItems);

        // Получаем информацию о пользователе
        $user = auth()->user();
        $address = $user->address;
        $userPhone = $user->phone_number;

        // Возвращаем представление с необходимыми данными
        return view('order.create', compact('cartItems', 'totalPrice', 'address', 'userPhone'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'regex:/^\+375[0-9]{9}$/',
            ],
        ]);


        $user = auth()->user();
        $userCart = Cart::where('user_id', $user->id)->first();
        $cartItems = $userCart ? $this->getCartItems(json_decode($userCart->items, true)) : [];
        $totalPrice = $this->totalPrice($cartItems);


        $orderData = [
            'user_id' => $user->id,
            'name' => $user->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'total_price' => $totalPrice,
        ];

        $order = Order::create($orderData);

        if ($userCart) {
            $userCart->items = json_encode([]);
            $userCart->save();
        }

        return redirect()->route('order.success')->with('success', 'Ваш заказ успешно оформлен!');
    }

    private function getCartItems($cart)
    {
        $cartItems = [];

        foreach ($cart as $menuId => $quantity) {
            $menu = Menu::find($menuId);
            if ($menu) {
                $quantityValue = is_array($quantity) && isset($quantity['quantity']) ? $quantity['quantity'] : (int)$quantity;
                $cartItems[] = (object)[
                    'menu' => $menu,
                    'quantity' => $quantityValue,
                ];
            }
        }

        return $cartItems;
    }


    private function totalPrice($cartItems)
    {
        return array_sum(array_map(function($item) {
            $price = is_numeric($item->menu->price) ? (float) $item->menu->price : 0;
            $quantity = is_numeric($item->quantity) ? (int) $item->quantity : 0;
            return $price * $quantity;
        }, $cartItems));
    }
}
