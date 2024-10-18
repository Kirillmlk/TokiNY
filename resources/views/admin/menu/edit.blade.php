@extends('components.layout')

@section('content')
    <h1>Редактировать элемент меню</h1>

    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <div class="input-group">
                <select name="category" id="category" class="form-control" required>
                    <option value="" disabled selected>Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ $menu->category === $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                <input type="text" name="new_category" id="new_category" class="form-control" placeholder="Введите новую категорию" aria-label="Введите новую категорию">
            </div>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $menu->price }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
