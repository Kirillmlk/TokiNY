@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Admin menu</h1>
        <p class="lead text-center">Admin menu. Here you can add, edit, or delete products.</p>

        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary m">Add new item</a>

        <div class="row mt-4">
            @foreach($menus as $menu)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">Цена: {{ $menu->price }} ₽</p>
                            <p class="card-text">{{ $menu->description }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-success">Edit</a>

                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
