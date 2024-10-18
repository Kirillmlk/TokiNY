<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all()->groupBy('category');
        return view('admin.menu.index', compact('menus'));
    }

    public function showMenu()
    {
        $menus = Menu::all()->groupBy('category');
        return view('pages.menu', compact('menus'));
    }

    public function create()
    {
        $categories = Menu::distinct()->pluck('category')->toArray();
        return view('admin.menu.create', compact('categories'));
    }

    public function edit(Menu $menu)
    {
        $categories = Menu::distinct()->pluck('category')->toArray();
        return view('admin.menu.edit', compact('menu', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category' => 'required_without:new_category|string|max:255',
            'new_category' => 'required_without:category|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menuData = $request->all();

        // Устанавливаем категорию на основе введенной новой категории или выбранной существующей
        if ($request->filled('new_category')) {
            $menuData['category'] = $request->new_category;
        } elseif ($request->filled('category')) {
            $menuData['category'] = $request->category;
        }

        // Проверка, что категория установлена
        if (!isset($menuData['category'])) {
            return back()->withErrors(['category' => 'Выберите категорию или введите новую.']);
        }

        if ($request->hasFile('image')) {
            $menuData['image'] = $request->file('image')->store('images', 'public');
        }

        Menu::create($menuData);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully!');
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

        $menu->update($request->only(['name', 'price', 'description', 'category']));

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::delete('public/' . $menu->image);
            }

            $imagePath = $request->file('image')->store('menu_images', 'public');
            $menu->image = $imagePath;
        }

        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully!');
    }
}
