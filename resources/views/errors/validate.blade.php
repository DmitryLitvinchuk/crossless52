@extends('layouts.app')

@section('content')

        <div class="row">
            <h1 class="mt-60 text-center">{{ $error }}</h1>
            <div class="col-xs-offset-3 col-xs-6 col-sm-offset-5 col-sm-2 col-md-offset-5 col-md-2 col-lg-offset-5 col-lg-2">
                <a class="btn btn-default btn-lg btn-block" href="{{ URL::previous() }}">Back</a>
            </div>
        </div>

@endsection