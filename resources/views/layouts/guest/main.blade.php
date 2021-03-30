<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Deliveboo</title>
         <!-- Styles -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
         <meta name="viewport" content="width=device-width, user-scalable=no" />
        <link href=" {{ asset('css/app.css')  }} " rel="stylesheet">
        <link href=" {{ asset('css/style.css')  }} " rel="stylesheet">

        <!-- includes the Braintree JS client SDK -->
        <script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>


 </head>
    <body>
      <header>
        @include('guest.header')
      </header>
      <main>
        @yield('content')
      </main>
      <footer>
        @include('guest.footer')
      </footer>

      @yield('script')
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
        $(document).ready(function(){

          // Login non effettuato
          $(".hamburger").on('click', function() {
          $(".route-in-out").toggleClass("menu--open");
          });
          
          $(".hamburger").on('click', function() {
          $(".home-jumbotron").toggleClass("back--none");
          });

          $(".hamburger").on('click', function() {
          $(".restaurant-jumbotron").toggleClass("back--none");
          });

          // Login effettuato
          $(".hamburger").on('click', function() {
          $(".user-logout").toggleClass("menu--open");
          });
        });
      </script>
    </body>
</html>
