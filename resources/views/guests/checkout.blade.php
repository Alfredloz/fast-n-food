@extends('layouts.app')
@section('braintree_script')
<script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
@endsection

@section('content')

  <div id="app">
    <div class="cart-checkout">
      <cart-component restaurant ="{{ $restaurant }}" style="position:relative"></cart-component>
    </div>
  </div>

    <div class="login-container">
    <h1>Procedi con il pagamento</h1>
      <div class="input-container">
        <!-- <label for="name">Nome</label> -->
        <i class="far fa-user"></i><input class="form-control" placeholder="Nome" type="text" name="name" id="name" required>
        <small class="error-checkout" id="error_name"></small>
      </div>
      <hr>

      <div class="input-container">
        <!-- <label for="phone">Telefono</label> -->
        <i class="fas fa-phone"></i><input class="form-control" type="text" placeholder="Telefono" name="phone" id="phone" required>
        <small class="error-checkout" id="error_phone"></small>
      </div>
      <hr>

      <div class="input-container">
        <!-- <label for="address">Indirizzo</label> -->
        <i class="fas fa-map-marker-alt"></i><input class="form-control" type="text" placeholder="Indirizzo" name="address" id="address" required>
        <small class="error-checkout" id="error_address"></small>
      </div>

    </div>

    <div id="dropin-wrapper">
      <div id="checkout-message"></div>
      <div style="width:60%; margin:auto;">
        <div id="dropin-container"></div>
      </div>
      <div class="login-container">
        <button id="submit-button" class="submit-payment">Submit payment</button>
      </div>
    </div>

<script>
  var button = document.querySelector('#submit-button');

  braintree.dropin.create({
    // la tokenization key per mostrare il form di pagamento viene generata dinamicamente
    authorization: "{{ Braintree\ClientToken::generate() }}",
    container: '#dropin-container'
  }, function (createErr, instance) {
    button.addEventListener('click', function () {
      if ( deliveryInfoValidation() ){
        const total = document.getElementById('total_price').innerHTML
        const inpName = document.getElementById("name").value;
        const inpPhone = document.getElementById("phone").value;
        const inpAddress = document.getElementById("address").value;
        const clientInfo = [inpName, inpPhone, inpAddress];
        instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
          $.get('{{ route('payment') }}', { payload, total }, function (response) {
            if (response.success) {
              const plates_bought = JSON.parse(localStorage.getItem('plates_bought'));
              // Invio dati per l'ordine al server
              $.get( '{{ route('order') }}', { plates_bought, total, clientInfo} , function(response){
                  console.log(response);
              });
              // Rimuovere il carrello da localStorage
              localStorage.removeItem('plates_bought');
              // alert('Payment successfull!');
              window.location.href = "{{route('ordine')}}"+`?name=${inpName}&phone=${inpPhone}&address=${inpAddress}`;
            } else {
              alert('Payment failed');
              console.log(payload);
            }
          }, 'json');
        });
      } else if( parseFloat( document.getElementById('total_price').innerHTML ) <= 0){
        window.location.href = "{{route('homepage')}}"
      }
    });
  });

  /**
   * Javascript validation for delivery info
   * @return true if the data are validated, false otherwise
   */
  function deliveryInfoValidation() {
    const inpName = document.getElementById("name");
    const inpPhone = document.getElementById("phone");
    const inpAddress = document.getElementById("address");
    const total_price = parseFloat( document.getElementById('total_price').innerHTML );

    if (!inpName.checkValidity()) {
      document.getElementById("error_name").innerHTML = inpName.validationMessage;
    } else {
      document.getElementById("error_name").innerHTML = '';
    }
    if (!inpPhone.checkValidity()) {
      document.getElementById("error_phone").innerHTML = inpPhone.validationMessage;
    } else {
      document.getElementById("error_phone").innerHTML = '';
    }
    if (!inpAddress.checkValidity()) {
      document.getElementById("error_address").innerHTML = inpAddress.validationMessage;
    } else {
      document.getElementById("error_address").innerHTML = '';
    }

    return inpName.checkValidity() && inpPhone.checkValidity() && inpAddress.checkValidity() && total_price > 0;
  }
</script>
@endsection
