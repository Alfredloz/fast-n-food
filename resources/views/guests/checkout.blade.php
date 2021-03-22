@extends('layouts.app')
@section('braintree_script')
<script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
@endsection

@section('content')


  <h1>Il pagamento qua sotto dovrebbe funzionare</h1>
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
      instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
        $.get('{{ route('payment') }}', {payload}, function (response) {
          if (response.success) {
            console.log(response);
            alert('Payment successfull!');
          } else {
            alert('Payment failed');
            console.log(payload);
          }
        }, 'json');
      });
    });
  });
</script>
@endsection
