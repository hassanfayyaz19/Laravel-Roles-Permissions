@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="list-group">
                        @can('create-post')
                        <a href="#" class="list-group-item list-group-item-action ">create</a>
                        @endcan
                        @can('update-post')
                        <a href="#" class="list-group-item list-group-item-action">update</a>
                        @endcan
                        @can('publish-post')
                        <a href="#" class="list-group-item list-group-item-action ">publish</a>
                        @endcan
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
