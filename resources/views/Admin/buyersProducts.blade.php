@extends('layouts.admin')

@section('content')

        <div class="col-md-8">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    Buyer Details
                </div>
                <div class="card-body">
                   <h5> Name: {{ $buyer->name }}</h5>
                   <h5> Email: {{ $buyer->email }}</h5>
                   <h5> Total Buy: {{ $products->count() }}</h5>
                </div>
            </div>

            <h5 class="my-3">Product Details</h5>
            @foreach($products as $value)
                <div class="card mb-3" >
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="{{ url('storage/'.$value->products->image) }}" class="card-img" alt="{{ $value->products->name }}">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $value->products->name }}</h5>
                            <p class="card-text">
                                {{ substr(strip_tags($value->products->description), 0, 150) }}
                                {{ strlen(strip_tags($value->products->description)) > 150 ? "..." : "" }}   
                            </p>
                            <h5>Quantity: {{ $value->quantity }}</h5>
                            <h5>Category: @foreach($value->products->category as $item)<span class="badge badge-secondary mr-2">{{$item->name}}</span>@endforeach</h5>
                            <p class="card-text"><small class="text-muted">Buy Date: {{ $value->products->created_at }}</small></p>
                        </div>
                      </div>
                    </div>
                  </div>

            @endforeach
            {{ $products->links() }}

        </div>
@endsection
