@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">

      <!--<div class="page-header">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>Find track</h1>
          </div>
          <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="sponsor">
              <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&serve=C6AILKT&placement=bootswatchcom" id="_carbonads_js"></script>
            </div>
          </div> 
        </div>
      </div>-->

        <!--<div class="row">
          <div class="col-lg-12">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th class="hidden-xs"></th>
                    <th></th>
                    <th>Title</th>
                    <th>Remixer</th>
                    <th>Artists</th>
                    <th>Label</th>
                    <th>Genre</th>
                    <th  class="hidden-xs">Release</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td  class="hidden-xs"> <img src="{{ $track -> cover }}" alt="" class="img-responsive img-34"></td>
                    <td>
                        <a href="javascript:void(0)" onclick="aud_play_pause(this)">
                            <i class="glyphicon control glyphicon-play-circle"></i>
                            <audio class="xnine-player" src="{{ $track -> preview }}" preload="auto"></audio>
                        </a>
                    </td>
                    <td> {{ $track -> title }} </td>
                    <td> {{ $track -> remixer }} </td>
                    <td>{{ $track -> artist }}</td>
                    <td>{{ $track -> label }}</td>
                    <td>{{ $track -> genre }}</td>
                    <td  class="hidden-xs">{{ $track -> release }}</td>
                    <td>
                        <a href="#" class="upload">
                            <span class="glyphicon glyphicon-upload"></span>
                        </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                       {!! Form::open([
                                'method' => 'DELETE',
                                'action' => ['TrackController@destroy', $track->id],
                            ]) !!}
                            {!! Form::submit('DELETE', ['class' => 'btn pull-left btn-danger']) !!}
                        {!! Form::close() !!}
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                       {!! Form::open([
                                'method' => 'get',
                                'action' => ['TrackController@index', $track->id]
                            ]) !!}
                            {!! Form::submit('ADD', ['class' => 'btn btn-success pull-right']) !!}
                        {!! Form::close() !!}
                  </div>
              </div>
              
                 
          </div>
        </div>-->
        <div class="row mt-20">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 track">
                <img src="{{ $track -> cover }}" alt="..." class="img-responsive track-image" style="width:100%">
                <div class="btn-group btn-group-justified mt-10 mb-10">
                      <div class="btn-group btn-group-lg">
                        <a href="javascript:void(0)" data-id="{{ $track -> id }}" onclick="aud_play_pause(this)" class="btn btn-default">
                            <i class="control fa fa-play" aria-hidden="true"></i>
                            <audio class="xnine-player track-source-url" src="{{ $track -> preview }}" preload="auto"></audio>
                        </a>
                      </div>
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-info"><i class="fa fa-link" aria-hidden="true"></i></button>
                      </div>
                      @if ($track -> track === NULL)
                          <div class="btn-group btn-group-lg">
                            <a href="tracks/{{ $track -> id }}/ChooseUploadFile" class="btn btn-warning track-link">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                            </a>
                          </div>
                        @else
                          <div class="btn-group btn-group-lg">
                            <a href="{{ $track -> id }}/download" class="btn btn-success track-link">
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </a>
                          </div>
                        @endif
                 </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <p class="text-muted m-0">Title:</p>
                <h2 class="m-0 track-title">{{$track -> title }}</h2>
                <p class="text-muted m-0">Remixer:</p>
                <h3 class="m-0">{{$track -> remixer }}</h3>
                <p class="text-muted m-0">Genre:</p>
                <h4 class="m-0">{{$track -> genre }}</h4>
                <p class="text-muted m-0">BPM:</p>
                <h4 class="m-0">{{$track -> bpm }}</h4>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <p class="text-muted m-0">Artist:</p>
                <h2 class="m-0 track-author">{{$track -> artist }}</h2>
                <p class="text-muted m-0">Label:</p>
                <h3 class="m-0">{{$track -> label }}</h3>
                <p class="text-muted m-0">Key:</p>
                <h4 class="m-0">{{$track -> key }}</h4>
                <p class="text-muted m-0">Release:</p>
                <h4 class="m-0">{{$track -> release }}</h4>
            </div>
        </div>

      <footer>
        <div class="row">
          <div class="col-lg-12">
              
          </div>
        </div>

      </footer>


    </div>

@endsection
    
