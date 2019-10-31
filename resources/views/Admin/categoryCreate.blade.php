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
                    @yield('title', 'Add New Category')
                </div>

                <div class="card-body">		
                    <form action="@yield('update-link', route('category.store'))" method="POST">
                        {{ csrf_field() }} @yield('method-put')
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="@yield('name', old('name'))" id="name" >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" >@yield('description', old('description'))</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  


                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">@yield('btn-text', 'Submit')</button>
                                @yield('btn-cancel')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
