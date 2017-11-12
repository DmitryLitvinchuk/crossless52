@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
      
        <div class="row mt-25 track">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <img src="{{ $soundcloudtrack -> cover }}" alt="..." class="img-responsive track-image" style="width:100%">
                <div class="btn-group btn-group-justified mt-10 mb-10">
                        <div class="btn-group btn-group-lg">
                            <a href="{{ $soundcloudtrack -> link }}" class="btn btn-info track-link" target="_blank">
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </a>
                        </div>
                        @if ($soundcloudtrack -> track !== NULL)
                            @if ($soundcloudtrack -> inspection !== 0)
                                <div class="btn-group btn-group-lg">
                                  <a href="{{ $soundcloudtrack -> id }}/download" class="btn btn-success">
                                      <i class="fa fa-download" aria-hidden="true"></i>
                                  </a>
                                </div>
                            @else
                                <div class="btn-group btn-group-lg">
                                  <a href="{{ $soundcloudtrack -> id }}/download" class="btn btn-default" data-toggle="tooltip" title="This track has not been checked!">
                                      <i class="fa fa-download" aria-hidden="true"></i>
                                  </a>
                                </div>
                            @endif
                        @endif
                 </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <p class="text-muted m-0">Title:</p>
                <h2 class="m-0 track-title">{{$soundcloudtrack -> title }}</h2>
                <p class="text-muted m-0">Genre:</p>
                <h4 class="m-0">{{$soundcloudtrack -> genre }}</h4>
                <p class="text-muted m-0">Artist:</p>
                <h2 class="m-0 track-author">{{$soundcloudtrack -> artist }}</h2>
                <p class="text-muted m-0">Release:</p>
                <h4 class="m-0">{{$soundcloudtrack -> release }}</h4>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                {!! Form::open(array('action' => array('SoundcloudController@update', $soundcloudtrack->id), 'method' => 'put')) !!}
					  <div class="form-group">
						{!! Form::label('artist', 'Atist:') !!}
						{!! Form::text('artist', $soundcloudtrack -> artist, ['class' => 'form-control']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('title', 'Title:') !!}
						{!! Form::text('title', $soundcloudtrack -> title, ['class' => 'form-control']) !!}
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
										'Funky / Groove / Jackin&#39; House' => 'Funky / Groove / Jackin&#39; House',], $soundcloudtrack -> genre, ['class' => 'form-control']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('release', 'Release date:') !!}
						{!! Form::text('release', $soundcloudtrack -> release, array('id' => 'datepicker'), ['class' => 'form-control']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::label('cover', 'Cover:') !!}
						{!! Form::text('cover', null, ['class' => 'form-control']) !!}
					  </div>
					  <div class="form-group">
						{!! Form::submit('edit', ['class' => 'btn btn-success btn-md form-control pull-right']) !!}
					  </div>
				  {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
    
