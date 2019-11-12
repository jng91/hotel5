@extends('template')
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Hotels</h1>
      <p class="lead">Lorem ipsum dolor sit amet consectetur adipiscing elit, facilisi fusce justo curabitur malesuada semper sed, suscipit hendrerit volutpat taciti in vel. A cum vehicula suscipit nibh magnis facilisi accumsan vel dictum auctor, gravida at neque fusce lobortis mus quam praesent. Litora volutpat magnis a ullamcorper nostra pharetra velit cum pulvinar felis tortor, vitae justo mus aptent ultricies pellentesque morbi et egestas ligula, eleifend rhoncus ad quam elementum faucibus dictumst dui diam aenean. Semper commodo vivamus venenatis rhoncus enim ac laoreet senectus pretium fringilla mus, sed torquent ultricies blandit at porta cursus litora curae urna.</p>
</div>
<div class="container">
    <div class="row">
    @foreach($hotels as $hotel)
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{$hotel->name}}</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>{{$hotel->description}}</li>
            </ul>
            <ul class="mt-3 mb-4">
              <li>Phone {{$hotel->phone}}</li>
              <li>Address {{$hotel->address}}</li>
            </ul>
            <a href="{{ route('hotel', $hotel->id)}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">View</button></a>
          </div>
        </div>
        @endforeach
    </div>
</div>
@endsection