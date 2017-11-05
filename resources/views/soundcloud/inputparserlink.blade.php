@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-lg-12">
           <h1>Add Track</h1>
            <blockquote>
                <p>
                    If you have not found a track on CrossLess, but you wanna add it. 
                    Paste link to this track in Beatport into this field.
                </p>
                <small>Link should be something like that <cite class="text-primary" title="Source Title">https://www.beatport.com/track/learning-to-fall-petar-dundov-remix/8762114</cite></small>
            </blockquote>
          </div>
        </div>
        <div class="row mt-20">
         		 {!! Form::open(['url' => 'soundcloudtracks']) !!}
					  <div class="form-group">
						{!! Form::label('link', 'Soundcloud link:') !!}
						{!! Form::text('link', null, ['class' => 'form-control']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::submit('create', ['class' => 'btn btn-success btn-md form-control pull-right']) !!}
					  </div>
				  {!! Form::close() !!}
      <footer>
        <div class="row">
          <div class="col-lg-12">
              
          </div>
        </div>

      </footer>


    </div>

@endsection
    
