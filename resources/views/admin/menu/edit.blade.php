@extends('components.layout')

@section('content')
    <h1>Редактировать элемент меню</h1>

    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
        </div>

        <div class="form-group">
            <label for="category">Категория</label>
            <input type="text" name="category" class="form-control" value="{{ $menu->category }}" required>
        </div>

        <div class="form-group">
            <label for="price">Цена</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $menu->price }}" required>
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" name="image" class="form-control">
            @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection
