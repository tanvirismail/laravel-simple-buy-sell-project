@extends('layouts.admin')

@section('content')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                        @if(auth()->user()->isAdmin())
                        i am admin
                        @endif


                </div>
            </div>
        </div>

@endsection
