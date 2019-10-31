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
                    Buyers List
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
                        @foreach($buyers as $value)
                            <tr>
                                <th scope="row">{{ $loop->iteration + ($buyers->perPage() * ($buyers->currentPage()-1)) }}</th>
                                <td>{{$value->user->name}}</td>
                                <td>{{$value->user->email}}</td>
                                <td>
                                <a href="{{ route('admin.buyers.products', $value->user->id) }}" class="btn btn-info text-white btn-sm" >Buy Products</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $buyers->links() }}
         
                </div>
            </div>
        </div>
@endsection
