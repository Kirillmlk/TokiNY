<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $menuId)
    {
        $product = Menu::find($menuId);

        // Проверка на наличие товара
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Товар не найден.'], 404);
        }

        // Получаем корзину из базы данных
        $userId = auth()->id();
        $userCart = Cart::firstOrNew(['user_id' => $userId]);
        $cart = json_decode($userCart->items, true) ?: [];

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

        // Сохраняем обновленную корзину в базе данных
        $userCart->items = json_encode($cart);
        $userCart->save();

        // Возврат ответа для AJAX
        return response()->json(['success' => true, 'item' => $cart[$menuId]]);
    }

    // Просмотр корзины
    public function index()
    {
        $userId = auth()->id();

        // Попробуем найти корзину для текущего пользователя
        $userCart = Cart::where('user_id', $userId)->first();

        // Проверяем, существует ли корзина
        if (!$userCart) {
            // Если корзины нет, возвращаем пустой массив товаров
            $cartItems = [];
            $totalPrice = 0; // Общая сумма равна 0
        } else {
            // Декодируем элементы корзины
            $cart = json_decode($userCart->items, true) ?: [];
            $cartItems = [];

            // Формирование массива товаров в корзине
            foreach ($cart as $menuId => $item) {
                $menu = Menu::find($menuId);
                if ($menu) {
                    $cartItems[] = (object)[
                        'menu' => $menu,
                        'quantity' => $item['quantity'],
                    ];
                }
            }

            // Считаем общую сумму
            $totalPrice = array_reduce($cartItems, function($carry, $item) {
                return $carry + ($item->menu->price * $item->quantity);
            }, 0);
        }

        // Передаем данные в представление
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function removeFromCart($menuId)
    {
        $userId = auth()->id();
        $userCart = Cart::where('user_id', $userId)->first();

        if (!$userCart) {
            return redirect()->route('cart.index')->with('error', 'Корзина не найдена.');
        }

        $cart = json_decode($userCart->items, true);

        // Удаление товара из корзины
        if (isset($cart[$menuId])) {
            unset($cart[$menuId]);
            $userCart->items = json_encode($cart);
            $userCart->save();
            return redirect()->route('cart.index')->with('success', 'Товар удален из корзины.');
        }

        return redirect()->route('cart.index')->with('error', 'Товар не найден в корзине.');
    }

    public function updateCart(Request $request, $menuId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $userId = auth()->id();
        $userCart = Cart::where('user_id', $userId)->first();

        if (!$userCart) {
            return redirect()->route('cart.index')->with('error', 'Корзина не найдена.');
        }

        $cart = json_decode($userCart->items, true);

        // Обновление количества товара в корзине
        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] = $request->input('quantity');
            $userCart->items = json_encode($cart);
            $userCart->save();
        }

        return redirect()->route('cart.index')->with('success', 'Корзина обновлена.');
    }
}
//test
