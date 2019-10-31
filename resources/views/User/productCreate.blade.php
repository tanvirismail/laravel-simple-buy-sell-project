@extends('layouts.user')

@section('content')

        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    @yield('title', 'Add New Product')
                </div>

                <div class="card-body">
                    <form action="@yield('update-link', route('product.store'))" method="POST" enctype="multipart/form-data">
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
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="@yield('quantity', old('quantity'))" id="quantity" >
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 
                            

                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                        <option value="available" 
                                        @if ( $__env->yieldContent('status')  == 'available' )selected="selected"@endif
                                        >available</option>
                                        <option value="unavailable"
                                        @if (  $__env->yieldContent('status')  == 'unavailable' )selected="selected"@endif
                                        >unavailable</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div> 

                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Categories</label>
                                    <div class="col-sm-10">
                                        <select name="category[]" multiple class="form-control @error('category') is-invalid @enderror" id="category">
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" 
                                                 @if (@collect(@$product->category)->pluck('id') && in_array($category->id, collect(@$product->category)->pluck('id')->toArray() ) )selected="selected"@endif
                                                >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div> 

                            <div class="form-group row">
                                    <label  for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                            <input name="image" type="file" class="form-control-file  @error('image') is-invalid @enderror" id="image">
                                    
                                            @error('image')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                      @yield('image')
                                      
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
