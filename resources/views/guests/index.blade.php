@extends('layouts.app')


@section('content')
<div class="banner-container">
  <div class="banner">
    <div class="banner-image">
      <img src="images/Artwork.svg" alt="">
    </div>
  
    <div class="banner-text">
      <h1>Consegna di cibo a domicilio e molto altro</h1>
      <h3>I migliori ristoranti di Fast and Food!</h3>
      <a class="discover-button" href="#typologies">Scopri di più</a>
    </div>
  </div>
</div>

<div class="slider-container">
  <div class="slider-container-2">
    <h1>Seleziona una o più tipologie</h1>
      <div class="slider-container-3">
        <button id="slideBack" type="button"><i class="fas fa-caret-left"></i></button>
        <div id="slider-typologies">
          <img src="{{ asset('/images/typologies/007-pizza.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/013-sandwich.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/002-sushi.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/011-salad.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/015-cake.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/026-ramen.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/029-burger.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/012-fried chicken.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/016-barbecue.png') }}" alt="Logo brand">
          <img src="{{ asset('/images/typologies/001-pancake.png') }}" alt="Logo brand">
        </div>
        <button id="slide" type="button"><i class="fas fa-caret-right"></i></button>
      </div>
  </div>
</div>

<div id="app">
  <home-component></home-component>
</div>

<div class="lavora">
  <div class="lavora-con-noi">
    <img src="images/Artwork.svg" alt="">
  </div>
  <div class="lavora-con-noi">
    <img src="images/Artwork3.svg" alt="">
  </div>
  <div class="lavora-con-noi">
    <img src="images/Artwork2.svg" alt="">
  </div>
</div>

<script>
  var button = document.getElementById('slide');
  button.onclick = function () {
      var container = document.getElementById('slider-typologies');
      sideScroll(container,'right',10,450,10);
  };

  var back = document.getElementById('slideBack');
  back.onclick = function () {
      var container = document.getElementById('slider-typologies');
      sideScroll(container,'left',10,450,10);
  };

  function sideScroll(element,direction,speed,distance,step){
      scrollAmount = 0;
      var slideTimer = setInterval(function(){
          if(direction == 'left'){
              element.scrollLeft -= step;
          } else {
              element.scrollLeft += step;
          }
          scrollAmount += step;
          if(scrollAmount >= distance){
              window.clearInterval(slideTimer);
          }
      }, speed);
  }
</script>

@endsection
