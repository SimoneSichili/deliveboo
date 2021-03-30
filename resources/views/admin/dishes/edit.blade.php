@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Modifica {{ $dish->name }}</h1>
    <div class="clearfix my-4">
        <a href="{{ route('admin.dishes.show', $dish->id) }}" class="btn dashboard-btn-back mb-4">Torna al piatto</a>
      </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="edit-form" action="{{ route("admin.dishes.update" , $dish->id ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome del piatto</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Inserisci il nome del piatto"
                value="{{ $dish->name }}">
        </div>

        <div class="form-group">
            <label for="description">Descrizione/Ingredienti</label>
            <textarea name="description" class="form-control" style="resize: none;" id="description" rows="6"
                placeholder="Inserisci la descrizione o gli ingredienti">{{ $dish->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Prezzo</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Inserisci il prezzo"
                value="{{ $dish->price }}">
        </div>

        <div class="form-group" style="margin-left: -15px; margin-right: -15px;">
            <div class=" col-12 col-md-6 col-lg-4">
                @if(!empty($dish->img_path))
                    <img class="img-fluid" src="{{ asset('storage/' . $dish->img_path) }}" alt="{{ $dish->name }}">
                @endif
                <label for="img_path" class="col-form-label mt-4">{{ __('Carica nuova immagine') }}</label>
                <input id="img_path" type="file" name="img_path" accept="image/*">
            </div>    
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="visible" id="visible" @if ($dish->visible == 1)
                checked @endif value="1">
                <label class="form-check-label" for="visible">Visibilità</label>
            </div>
        </div>

        <div class="my-4">
            <button type="submit" class="btn btn-success">Salva</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection