@extends('template')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Reservations</h1>
<div class="container">
    <div class="row">
    @foreach($reservations as $reservation)
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{$reservation->id}} - {{$reservation->created_at}}</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4 text-left">
              <li><b>Hotel:</b> {{$reservation->hotel->name}}</li>
              <li><b>Customer:</b> {{$reservation->customer->firstname}} {{$reservation->customer->lastname}}</li>
              <li><b>Email:</b> {{$reservation->customer->email}}</li>
              <li><b>Checkin:</b> {{$reservation->checkin}}</li>
              <li><b>Checkout:</b> {{$reservation->checkout}}</li>
              <li><b>Number of people:</b> {{$reservation->num_people}}</li>
              <li><b>Comment:</b> {{$reservation->comment}}</li>
              <li><b>Total price:</b> {{$reservation->total_price}} €</li>
            </ul>
            @if($reservation->confirm)
              <button type="button" class="btn btn-lg btn-block btn-outline-primary">Confirmed</button>
            @else
              @if($reservation->rejected)
                <button type="button" class="btn btn-lg btn-block btn-outline-primary">Rejected</button>
              @else
                @if( Auth::user()->admin == true )
                <a href="{{ route('confirmreservation', $reservation->id)}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Confirm</button></a>
                <a href="{{ route('rejectedreservation', $reservation->id)}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Rejected</button></a>
                @else
                  <button type="button" class="btn btn-lg btn-block btn-outline-primary">Waiting answer</button>
                @endif
              @endif
            @endif
          </div>
        </div>
        @endforeach
    </div>
</div>
@endsection