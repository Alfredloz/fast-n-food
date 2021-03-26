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
