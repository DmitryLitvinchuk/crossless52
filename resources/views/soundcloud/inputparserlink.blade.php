@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-lg-12">
           <h1>Add Your Soundcloud Track</h1>
            <blockquote>
                <p>
                    Add your track from Soundcloud and get PROMO!
                </p>
                <small>Link should be something like that <cite class="text-primary" title="Source Title">https://soundcloud.com/dancepointmusic/martin-garrix-id-creamfields-2017-fl-studio-remake-free-flp</cite></small>
            </blockquote>
          </div>
        </div>
        <div class="row mt-20">
        		 <div class="col-lg-12">
        		 	{!! Form::open(['url' => 'soundcloudtracks']) !!}
					  <div class="form-group">
						{!! Form::label('artist', 'Artist:') !!}
						{!! Form::text('artist', null, ['class' => 'form-control', 'required']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('title', 'Title:') !!}
						{!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('genre', 'Genre:') !!}
						{!! Form::select('genre', [
										'Indie Dance / Nu Disco' => 'Indie Dance / Nu Disco',
										'Deep House' => 'Deep House',
										'Tech House' => 'Tech House',
										'Big Room' => 'Big Room',
										'House' => 'House',
										'Techno' => 'Techno',
										'Psy-Trance' => 'Psy-Trance',
										'Future House' => 'Future House',
										'Drum &amp; Bass' => 'Drum &amp; Bass',
										'Electro House' => 'Electro House',
										'Dance' => 'Dance',
										'Hip-Hop' => 'Hip-Hop',
										'Trance' => 'Trance',
										'Minimal' => 'Minimal',
										'Electronica / Downtempo' => 'Electronica / Downtempo',
										'Trap' => 'Trap',
										'Progressive House' => 'Progressive House',
										'Dubstep' => 'Dubstep',
										'Hard Dance' => 'Hard Dance',
										'Funk / R&amp;B' => 'Funk / R&amp;B',
										'Breaks' => 'Breaks',
										'Glitch Hop' => 'Glitch Hop',
										'Dubstep' => 'Dubstep',
										'Hardcore / Hard Techno' => 'Hardcore / Hard Techno',
										'Funk / Soul / Disco' => 'Funk / Soul / Disco',
										'Reggae / Dancehall / Dub' => 'Reggae / Dancehall / Dub',
										'Funky / Groove / Jackin&#39; House' => 'Funky / Groove / Jackin&#39; House',], null, ['class' => 'form-control']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('release', 'Release date:') !!}
						{!! Form::text('release', '', array('id' => 'datepicker'), ['class' => 'form-control', 'required']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('email', 'Email (for communication):') !!}
						{!! Form::text('email', '', ['class' => 'form-control', 'required']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('link', 'Link (to Soundcloud):') !!}
						{!! Form::text('link', null, ['class' => 'form-control']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::submit('create', ['class' => 'btn btn-success btn-md form-control pull-right']) !!}
					  </div>
				  {!! Form::close() !!}
        		 </div>


    </div>

@endsection
    
