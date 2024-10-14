<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function createOrder()
    {
        $cart = Session::get('cart', []);
        $cartItems = $this->getCartItems($cart);
        $totalPrice = $this->totalPrice($cartItems);

        $user = auth()->user(); // Получение текущего пользователя
        $address = $user->address; // Получение адреса пользователя
        $userPhone = $user->phone_number; // Получение номера телефона пользователя

        return view('order.create', compact('cartItems', 'totalPrice', 'address', 'userPhone'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'regex:/^\+375[0-9]{9}$/', // Регулярное выражение для проверки формата
            ],
        ]);

        $user = auth()->user();
        $cartItems = $this->getCartItems(Session::get('cart', []));
        $totalPrice = $this->totalPrice($cartItems);

        $orderData = [
            'user_id' => $user->id,
            'name' => $user->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'total_price' => $totalPrice,
        ];

        $order = Order::create($orderData);

        Session::forget('cart');

        return redirect()->route('order.success')->with('success', 'Ваш заказ был успешно оформлен!');
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
