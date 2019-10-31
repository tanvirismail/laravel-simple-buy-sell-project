@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
            <div class="col-md-12">
                <div class="row">
                    @php $sellerId = @auth()->user()->id @endphp
					@foreach($products as $value)
					<div class="col-md-3">
						<div class="card mb-3 @if($sellerId == $value->seller_id) border-warning @endif" >
							<div class="row no-gutters">
							  <div class="col-md-4">
								<img src="{{ url('storage/'.$value->image) }}" class="card-img" alt="{{ $value->name }}">
							  </div>
							  <div class="col-md-8">
								<div class="card-body">
									<h5 class="card-title">
										<a href="{{route('product.show', $value->id)}}">{{ $value->name }}</a>
									</h5>
									<p class="card-text">
										{{ substr(strip_tags($value->description), 0, 50) }}
										{{ strlen(strip_tags($value->description)) > 50 ? "..." : "" }}   
									</p>
									<h5>Quantity: {{ $value->quantity }}</h5>
									@if($sellerId != $value->seller_id)
										<a href="{{route('product.show', $value->id)}}" class="btn btn-success">Buy</a>
									@endif
								</div>
							  </div>
							</div>
						  </div>
					</div>
            @endforeach
            </div>
            </div>
            <div class="col-md-12">
                {{ $products->links() }}
            </div>
    </div>
</div>
@endsection
