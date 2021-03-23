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
      <a class="discover-button" href="#typologies">Inizia ora</a>
    </div>
  </div>

  <div class="curvature"></div>
</div>

<section id="typologies"></section>
<!-- <div class="slider-container">
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
</div> -->

<div id="app">
  <home-component></home-component>
</div>

<div class="lavora-con-noi-container">
  <div class="lavora-con-noi">
    <img src="images/Artwork.svg" alt="">
    <h1>1000+ ristoranti</h1>
    <p>Con oltre mille ristoranti puoi ordinare i tuoi piatti preferiti, esplora nuovi ristoranti in zona!</p>
  </div>
  <div class="lavora-con-noi">
    <img src="images/Artwork3.svg" alt="">
    <h1>Consegna rapida </h1>
    <p>La rapidità è un nostro punto d'orgoglio. Ordina o invia qualsiasi cosa nella tua città e lo ritireremo e te lo consegneremo nel giro di pochi minuti.</p>
  </div>
  <div class="lavora-con-noi">
    <img src="images/Artwork2.svg" alt="">
    <h1>Consegna della spesa e altro</h1>
    <p>Trova tutto ciò che ti serve! Dai supermercati ai negozi, puoi contare su di noi per portartelo.</p>
  </div>
</div>

@endsection
