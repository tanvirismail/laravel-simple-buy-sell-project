@extends('User.productCreate')
@section('title', 'Edit Product')
@section('btn-text', 'Update')

@section('btn-cancel') <a href=" {{ route('product.index') }}" class="btn btn-dark" >Cancel</a> @stop
@section('update-link', route('product.update', $product->id) )
@section('method-put') {{ method_field('PUT') }} @stop
@section('name', $product->name)
@section('description', $product->description)
@section('quantity', $product->quantity)
@section('status', $product->status)


@section('image')

        <img src="{{ url('storage/'.$product->image) }}" width="120" class="mr-2"/>

@stop