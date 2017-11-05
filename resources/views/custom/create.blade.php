@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container mt-20">
        <div class="row">
          {!! Form::open(['url' => 'customtracks', 'files' => true]) !!}
			  <div class="form-group">
				{!! Form::label('title', 'Titile:') !!}
				{!! Form::text('title', null, ['class' => 'form-control']) !!}
			  </div>
       	 	  <div class="form-group">
				{!! Form::label('artist', 'Artist:') !!}
				{!! Form::text('artist', null, ['class' => 'form-control']) !!}
			  </div>
        	  <div class="form-group">
				{!! Form::label('track', 'File:') !!}
				{!! Form::file('track') !!}
			  </div>
        	  <div class="form-group">
				{!! Form::label('image', 'Image:') !!}
				{!! Form::text('image') !!}
			  </div>
         	  <div class="form-group">
				{!! Form::submit('create', ['class' => 'btn btn-success btn-md form-control pull-right']) !!}
			  </div>
          {!! Form::close() !!}
        </div>
    </div>

@endsection