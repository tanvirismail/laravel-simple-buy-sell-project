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
                    Sellers List
                </div>

                <div class="card-body">
                    
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sellers as $value)
                            <tr>
                                <th scope="row">{{ $loop->iteration + ($sellers->perPage() * ($sellers->currentPage()-1)) }}</th>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                <td>
                                    <a href="{{ route('admin.sellers.products', $value->id) }}" class="btn btn-info text-white btn-sm" >Seller Products</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $sellers->links() }}
         
                </div>
            </div>
        </div>
@endsection
