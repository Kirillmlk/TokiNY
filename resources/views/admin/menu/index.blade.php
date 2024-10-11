@extends('components.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Меню</h1>
        <p class="lead text-center">Меню администратора. Тут вы можете добавлять, изменять или удалять продукты.</p>

        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary m">Добавить новое меню</a>

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
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-success">Редактировать</a>

                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот элемент?');">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
