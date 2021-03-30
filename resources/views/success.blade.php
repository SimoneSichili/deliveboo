@extends('layouts.guest.main')

@section('content')
<section id="success">
  <div class="mycontainer" data-aos="fade-right" data-aos-delay="0" data-aos-duration="1000">
    <img src="{{asset("img/success/driver2.jpeg")}}" alt="">
    <h3>Buone notizie, il tuo ordine è stato confermato!</h3>
    <h4> Riceverai un' e-mail con i dettagli relativi allo stato del tuo ordine.</h4>
    <a class="home-btn" href="{{ route('welcome') }}">Torna alla home</a>
  </div>
</section>
@endsection