@extends('layouts.app')

@section('content')
<div class="container">
   
    <section>
        @if( session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
        <div class="row">
            @foreach( $products as $product)
              <div class="col-md-4">

                <div class="card mb-2">
                    <img src="{{ $product->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">"{{ $product->title_.app() -> getLocale() }}"</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                      <p class="card-text">Sld on thd make up the bulk of the card's content.</p>
                      <p><strong> $ {{ $product->price }}</strong></p>
                      <a href="{{ route('cart.add',$product->id)}}" class="btn btn-primary">Buy</a>
                    </div>
                  </div>
              </div>
            @endforeach
        </div>
    </section>

</div>


@endsection