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

        // Проверка на наличие товара
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Товар не найден.'], 404);
        }

        // Получаем корзину из сессии
        $cart = Session::get('cart', []);

        // Добавление товара в корзину
        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += 1;
        } else {
            $cart[$menuId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        // Сохранение корзины в сессии
        Session::put('cart', $cart);
        $this->saveCartToDatabase($cart);

        // Возврат ответа для AJAX
        return response()->json(['success' => true, 'item' => $cart[$menuId]]);
    }

    protected function saveCartToDatabase($cart)
    {
        $userId = auth()->id();

        // Получаем существующую корзину пользователя или создаем новую запись
        $userCart = Cart::firstOrNew(['user_id' => $userId]);

        // Сохраняем товары как JSON
        $userCart->items = json_encode($cart);
        $userCart->save();
    }

    // Просмотр корзины
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];

        // Формирование массива товаров в корзине
        if ($cart) {
            foreach ($cart as $menuId => $item) {
                $menu = Menu::find($menuId);

                if ($menu) {
                    $cartItems[] = (object)[
                        'menu' => $menu,
                        'quantity' => $item['quantity'],
                    ];
                }
            }
        }

        // Считаем общую сумму
        $totalPrice = array_sum(array_map(function ($item) {
            return $item->menu->price * $item->quantity;
        }, $cartItems));

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function removeFromCart($menuId)
    {
        $cart = Session::get('cart', []);

        // Удаление товара из корзины
        if (isset($cart[$menuId])) {
            unset($cart[$menuId]);
            Session::put('cart', $cart);
            // Обновляем данные в базе
            $this->saveCartToDatabase($cart);
            return redirect()->route('cart.index')->with('success', 'Товар удален из корзины.');
        }

        return redirect()->route('cart.index')->with('error', 'Товар не найден в корзине.');
    }

    public function updateCart(Request $request, $menuId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = Session::get('cart', []);

        // Обновление количества товара в корзине
        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] = $request->input('quantity');
            Session::put('cart', $cart);
            // Обновляем данные в базе
            $this->saveCartToDatabase($cart);
        }

        return redirect()->route('cart.index')->with('success', 'Корзина обновлена.');
    }
}
