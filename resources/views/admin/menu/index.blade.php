@extends('components.layout')

@section('content')
    <div class="container">
        <h1>Меню</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Добавить новое меню</a>

        <div class="row mt-4">
            @foreach($menus as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">Цена: {{ $menu->price }} ₽</p>
                            <p class="card-text">{{ $menu->description }}</p>
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-warning">Редактировать</a>

                            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот элемент?');">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
