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
                    Category <a href="{{ route('category.create') }}" class="btn btn-success btn-sm float-right" >Add New</a>
                </div>

                <div class="card-body">
                    
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $value)
                            <tr>
                                <th scope="row">{{ $loop->iteration + ($categories->perPage() * ($categories->currentPage()-1)) }}</th>
                                <td>{{$value->name}}</td>
                                <td>
                                        {{ substr(strip_tags($value->description), 0, 50) }}
                                        {{ strlen(strip_tags($value->description)) > 50 ? "..." : "" }}    
                                </td>
                                <td>
                                    <a href="{{ route('category.edit',$value->id) }}" class="btn btn-info btn-sm" >edit</a>
                                    <a href="javascript:void(0);" onclick="if(confirm('Are You Sure?')) { event.preventDefault();document.getElementById('delete-form-{{$value->id}}').submit();}" class="btn btn-sm btn-danger">Delete</a>
                                    <form id="delete-form-{{$value->id}}" action="{{ route('category.destroy', $value->id ) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}{{method_field('DELETE')}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
         
                </div>
            </div>
        </div>

@endsection
