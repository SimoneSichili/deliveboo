@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center">{{ $dish->name }}</h1>
    <div class="clearfix my-4">
      <a href="{{ route('admin.dishes.index') }}" class="btn dashboard-btn-back mb-4">Torna all'elenco piatti</a>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <img class="img-fluid" src="{{ asset('storage/' . $dish->img_path) }}" alt="{{ $dish->name }}">
        </div>
    </div>
    <table class="table table-striped table-bordered table-dark table-show my-4">
        <tr>
            <td><strong>ID</strong></td>
            <td>{{ $dish->id }}</td>
        </tr>
        <tr>
            <td><strong>Nome del piatto</strong></td>
            <td>{{ $dish->name }}</td>
        </tr>
        <tr>
            <td><strong>Prezzo</strong></td>
            <td>{{ $dish->price }} €</td>
        </tr>
        <tr>
            <td><strong>Descrizione</strong></td>
            <td>{{ $dish->description }}</td>
        </tr>
        <tr>
            <td><strong>Visibilità</strong></td>
            <td>
                @if ( $dish->visible )
                SI
                @else
                NO
                @endif
            </td>
        </tr>
    </table>
    <div class="clearfix mt-4">
        <a href="{{ route('admin.dishes.edit', $dish->id) }}" class="btn btn-success">Modifica</a>
        <form class="destroy-form" action="{{ route('admin.dishes.destroy', $dish->id) }}" method="POST"
            onsubmit="return confirm('Sei sicuro di voler eliminare questo piatto?')">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger mt-2">Elimina</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection