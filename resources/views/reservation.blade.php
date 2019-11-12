@extends('template')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Reservation</h1>
<div class="container">
    <div class="row">
        <div class="card mb-4 box-shadow w-100">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Confirmed reservation</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4 text-left">
              <li><b>Reference:</b> {{$reservation->id}}</li>
              <li><b>Hotel:</b> {{$reservation->hotel->name}}</li>
              <li><b>Customer:</b> {{$reservation->customer->firstname}} {{$reservation->customer->lastname}}</li>
              <li><b>Email:</b> {{$reservation->customer->email}}</li>
              <li><b>Checkin:</b> {{$reservation->checkin}}</li>
              <li><b>Checkout:</b> {{$reservation->checkout}}</li>
              <li><b>Number of people:</b> {{$reservation->num_people}}</li>
              <li><b>Comment:</b> {{$reservation->comment}}</li>
              <li><b>Total price:</b> {{$reservation->total_price}} €</li>
            </ul>
          </div>
        </div>
    </div>
</div>
@endsection