@extends('layouts.app')
@section('braintree_script')
<script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
@endsection

@section('content')

  <div id="app">
      <cart-component restaurant ="{{ $restaurant }}" style="position:relative"></cart-component>
  </div>

    <div class="info_delivery">
      <label for="name">Nome</label>
      <input type="text" name="name" id="name" required>
      <small id="error_name"></small>

      <label for="phone">Telefono</label>
      <input type="text" name="phone" id="phone" required>
      <small id="error_phone"></small>

      <label for="address">Indirizzo</label>
      <input type="text" name="address" id="address" required>
      <small id="error_address"></small>

    </div>

    <div id="dropin-wrapper">
      <div id="checkout-message"></div>
      <div style="width:60%; margin:auto;">
        <div id="dropin-container"></div>
      </div>
      <button style="background-color:yellow" id="submit-button">Submit payment</button>
    </div>

    <h2>La doc di braintree è brutta forte e malvagia</h2>


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
        instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
          $.get('{{ route('payment') }}', { payload, total }, function (response) {
            if (response.success) {
              const plates_bought = JSON.parse(localStorage.getItem('plates_bought'));
              // Invio dati per l'ordine al server
              $.get( '{{ route('order') }}', { plates_bought, total} , function(response){
                  console.log(response);
              });
              alert('Payment successfull!');
            } else {
              alert('Payment failed');
              console.log(payload);
            }
          }, 'json');
        });
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

    return inpName.checkValidity() && inpPhone.checkValidity() && inpAddress.checkValidity();
  }
</script>
@endsection
