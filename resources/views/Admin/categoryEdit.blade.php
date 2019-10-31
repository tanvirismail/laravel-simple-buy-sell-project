@extends('Admin.categoryCreate')
@section('title', 'Edit Category')
@section('btn-text', 'Update')

@section('btn-cancel') <a href=" {{ route('category') }}" class="btn btn-dark" >Cancel</a> @stop
@section('update-link', route('category.update', $category->id) )
@section('method-put') {{ method_field('PUT') }} @stop
@section('name', $category->name)
@section('description', $category->description)