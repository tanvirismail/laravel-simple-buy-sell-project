@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @error('quantity')
              <div class="alert alert-danger">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
                
            <div class="card mb-3 @if( @auth()->user()->id == $product->seller_id) border-warning @endif" >
              <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="{{ url('storage/'.$product->image) }}" class="card-img" alt="{{ $product->name }}">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                {{ $product->description }}   
                            </p>
                            <h5>Available Quantity: {{ $product->quantity }}</h5>
                            <h5>Category: @foreach($product->category as $item)<span class="badge badge-secondary mr-2">{{$item->name}}</span>@endforeach</h5>

                            @if( @auth()->user()->id != $product->seller_id)
                          <form action="{{ route('product.buy',$product->id) }}" method="POST">
                              {{csrf_field()}}
                              <input name="id" type="hidden" value="{{$product->id}}" />
                              <p>Quantity: <input name="quantity" type="number" value="1" min='1'/></p>
                              <button type="submit" class="btn btn-success">Buy Now</button>
                            </form>
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
    </div>
</div>
@endsection