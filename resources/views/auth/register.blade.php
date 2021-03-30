@extends('layouts.admin.login')

@section('content')
<div class="mycontainer space">
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header text-center header">{{ __('Registrazione') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 box">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome Ristorante') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Inserisci il nome del ristorante">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus placeholder="Inserisci l'indirizzo del ristorante">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="p_iva" class="col-md-4 col-form-label text-md-right">{{ __('P IVA') }}</label>

                                <div class="col-md-6">
                                    <input id="p_iva" type="text" class="form-control @error('p_iva') is-invalid @enderror" name="p_iva" value="{{ old('p_iva') }}" required autocomplete="p_iva" autofocus placeholder="Inserisci la Partita IVA">

                                    @error('p_iva')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrizione') }}</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" style="resize: none;" name="description" id="description"  rows="5" placeholder="Inserisci la descrizione del Ristorante">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="img_path" class="col-md-4 col-form-label text-md-right">{{ __('Carica Immagine') }}</label>

                                <div class="col-md-6">
                                    <input id="img_path" type="file" name="img_path" accept="image/*">
                                </div>
                            </div>
                        
                            <div class="form-group margin">
                                <div class="text-center">
                                    @foreach ($categories as $category)         
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                                        <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>
            
                        <div class="form-group row mb-0">
                            <div class="col-8 offset-2 col-md-6 offset-md-4">
                                <a href="{{ url('/') }}" class="btn btn-white" id="return">
                                    {{ __('Torna al sito') }}
                                </a>
                                <button type="submit" class="btn btn-orange">
                                    {{ __('Registrati') }}
                                </button>
                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
