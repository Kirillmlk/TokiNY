<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Отображаем все элементы меню для админа
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        // Форма для добавления нового элемента меню
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        // Валидация данных и добавление элемента меню
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully!');
    }

    public function edit(Menu $menu)
    {
        // Форма для редактирования элемента меню
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        // Валидация данных и обновление элемента меню
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully!');
    }
}
