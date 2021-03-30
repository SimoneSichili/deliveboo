@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Crea un nuovo piatto</h1>
    <div class="clearfix my-4">
        <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary mb-4">Torna all'elenco piatti</a>
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
    <form action="{{ route("admin.dishes.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="name">Nome del piatto</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Inserisci il nome del piatto"
                value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Descrizione/Ingredienti</label>
            <textarea name="description" class="form-control" style="resize: none;" id="description" rows="6"
                placeholder="Inserisci la descrizione o gli ingredienti">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Prezzo</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Inserisci il prezzo"
                value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="img_path" class="col-form-label d-block">{{ __("Carica immagine") }}</label>
            <input id="img_path" type="file" name="img_path" accept="image/*">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="visible" id="visible" @if (old('visible')==1)
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