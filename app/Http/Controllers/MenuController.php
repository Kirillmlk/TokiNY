<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menuData = $request->all();


        if ($request->hasFile('image')) {
            $menuData['image'] = $request->file('image')->store('images', 'public');
        }

        Menu::create($menuData);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully!');
    }



    public function edit(Menu $menu)
    {

        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Обновляем данные меню
        $menu->update($request->only(['name', 'price', 'description', 'category']));

        // Проверяем, загружено ли новое изображение
        if ($request->hasFile('image')) {
            // Удаляем старое изображение, если оно существует
            if ($menu->image) {
                Storage::delete('public/' . $menu->image);
            }

            // Сохраняем новое изображение
            $imagePath = $request->file('image')->store('menu_images', 'public');
            $menu->image = $imagePath; // Обновляем поле image
        }

        // Сохраняем изменения в базе данных
        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully!');
    }
}
