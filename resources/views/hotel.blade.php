@extends('template')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">{{$hotel->name}}</h1>
      <p class="lead">{{$hotel->description}}</p>
</div>
<div class="container">
<div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">1</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Product name</h6>
                <small class="text-muted">{{$hotel->name}}</small>
              </div>
              <span class="text-muted" id='price'>0 €</span>
            </li>
            <li class="list-group-item d-flex justify-content-between" id='total'>
              <span>Total (€)</span>
              <strong></strong>
            </li>
          </ul>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form method="POST" action="{{ route('savereservation')}}" id="reservation" class="needs-validation" novalidate="">
          @csrf
          <input type="hidden" id="id_hotel" name="id_hotel" value="{{$hotel->id}}">
          <div class="row">
              <div class="col-md-6 mb-3">
                <label for="checkin">Check-in</label>
                <input type="text" id="checkin" name="checkin" class="form-control datepicker @error('checkin') is-invalid @enderror" placeholder="" value="" required="">
                @error('checkin')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="checkout">Check-out</label>
                <input type="text" class="form-control datepicker @error('checkout') is-invalid @enderror" id="checkout" name="checkout" placeholder="" value="" required="">
                @error('checkout')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <h4 class="mb-3">Rooms</h4>
                @foreach($rooms as $room)
                  <input type="radio" name="room" class="room" value="{{$room->id}}" required="" checked> {{$room->name}} - {{$room->price}} €<br>
                @endforeach
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="comments">Comments</label>
                <input type="text" class="form-control" id="comment" name="comment" placeholder="" value="" >
              </div>
              <div class="col-md-6 mb-3">
                <label for="num_people">Number of people</label>
                <input type="number" class="form-control @error('num_people') is-invalid @enderror" id="num_people" name="num_people" placeholder="1" value="1" >
                @error('num_people')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="">
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input">
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" >
                <label class="custom-control-label" for="paypal">Paypal</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" >
                <small class="text-muted">Full name as displayed on card</small>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" >
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" >
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" >
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
          </form>
        </div>
      </div>
</div>
@endsection

@section('javascript')
$('.datepicker').datepicker({
  dateFormat: 'yy-mm-dd',
    startDate: '+1d'
});

var prices = new Array;
@foreach($rooms as $room)
prices[{{$room->id}}]={{$room->price}};
@endforeach

$('#reservation input[name=room]').on('change', function() {
  calculatePrice();
});

$('#reservation input[name=checkout]').on('change', function() {
  calculatePrice();
});

$('#reservation input[name=checkin]').on('change', function() {
  calculatePrice();
});


function calculatePrice()
{
    var idhotel = $('input[name=room]:checked', '#reservation').val();
    $("#price").html(prices[idhotel]+" €");
    var datecheckin = moment($('#checkin').val());
    var datecheckout = moment($('#checkout').val());
    var days = datecheckout.diff(datecheckin, 'days');
    if($('#checkin').val() != '')
      $("#total").html((days*prices[idhotel])+" (€)");
}
@endsection