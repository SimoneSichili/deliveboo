@extends('layouts.guest.main')

@section('content')
<div id="cart">

  {{-- Restaurant Jumbotron Section --}}
  <div class="restaurant-jumbotron" style="background-image: url({{ asset('storage/' . $restaurant->img_path)}})">
    <div class="overlay"></div>
    <div class="mycontainer">
        <div class="jumbotron-text" data-aos="fade-right" data-aos-delay="250" data-aos-duration="3000">
          <h1>{{$restaurant->name}}</h1>
          <p>Il nostro men&ugrave; <i class="fas fa-chevron-down"></i></p>
        </div>
    </div>
  </div>
  {{-- /Restaurant Jumbotron Section --}}

  <div class="mycontainer show-restaurant-container row">

    {{-- Menu Section --}}
    <div class="menu-container col-12  col-lg-6 col-xl-7">
      @foreach ($restaurant->dishes as $dish)
        @if($dish->visible == true)
          <div class="dish-card" data-aos="fade-right" data-aos-delay="0" data-aos-duration="800">
              <div class="image-container">
                <img class="card-image" src="{{asset('storage/' . $dish->img_path)}}" alt="{{$dish->name}}">
              </div>
              <div class="card-body">
                <div class="dish-description">
                  <h5 class="card-title">{{ $dish->name }}</h5>
                  <p class="card-text">{{ $dish->description }}</p>
                </div>
                <div class="add-dish">
                  <span @click='addToCart({{ json_encode($dish) }})'><i class="fas fa-plus"></i></span>
                  <span class="dish-price">&euro; {{ number_format($dish->price, 2) }}</span>
                </div>
              </div>
          </div>
        @endif
      @endforeach
    </div>
    {{-- /Menu Section --}}

    {{-- Cart Section --}}
    <div class="cart-container col-12 col-lg-5 offset-lg-1 col-xl-4 offset-xl-1" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1000">
      <div class="checkout-restaurant">
        <span class="home-btn off-btn" v-if="calculateTotal == 0">Vai alla cassa</span>
        <a @click='checkout' class="home-btn" v-else href="{{ route('checkout', $restaurant->slug) }}">Vai alla cassa</a>
      </div>
      <div class="show-cart" v-for='dish in cart' data-aos="zoom-in" data-aos-duration="200">
        {{-- <img :src="'./../storage/' + dish.item.img_path" :alt="dish.item.name"> --}}
        <span class="quantity-section">
          <span class="quantity-btn minus-sign" @click='decreaseQuantity(dish)'>-</span>
          <span class="quantity-number">@{{dish.quantity}}</span>
          <span class="quantity-btn plus-sign" @click='increaseQuantity(dish)'>+</span>
        </span>
        <span class="dish-name">@{{dish.item.name}}</span>
        <span class="dish-price">€ @{{(dish.item.price * dish.quantity).toFixed(2)}}</span>
      </div>
      <span class="empty-cart" v-if="calculateTotal == 0">Il tuo carrello è vuoto</span>
      <div class="total-cart" v-else>
        <span>Totale</span>
        <span class="restaurant-total">€ @{{calculateTotal.toFixed(2)}}</span>
      </div>
    {{-- /Cart Section --}}

  </div>
</div>



@endsection

@section('script')
  <script src="{{ asset('js/cart.js') }}"></script>
@endsection