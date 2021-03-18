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

@endsection
