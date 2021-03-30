@extends('layouts.app')
@section('content')
    <div class="container text-center" id="dashboard-cards">
        <h1 class="mb-3">Benvenuto {{ Auth::user()->name }}</h1>
        <div class="row">
            <div class="col-12 col-sm-6 offset-lg-2 col-lg-4">
                <div class="card card-black">
                    <img class="card-img-top" src="{{ asset('img/dashboard/food.jpg') }}" alt="Piatti">
                    <div class="card-body">
                        <a class="btn btn-lg btn-primary dashboard-btn" href="{{ route('admin.dishes.index') }}">Piatti</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card card-black">
                    <img class="card-img-top" src="{{ asset('img/dashboard/cart.jpg') }}" alt="Piatti">
                    <div class="card-body">
                        <a class="btn btn-lg btn-primary dashboard-btn" href="{{ route('admin.stats') }}">Ordini</a>
                    </div>
                </div>
            </div>         
        </div>   
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
