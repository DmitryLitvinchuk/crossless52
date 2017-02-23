@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-25 track">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <img src="{{ $track -> cover }}" alt="..." class="img-responsive track-image" style="width:100%">
                <div class="btn-group btn-group-justified mt-10 mb-10">
                      <div class="btn-group btn-group-lg">
                        <a href="javascript:void(0)" onclick="aud_play_pause(this)" class="btn btn-default">
                            <i class="control fa fa-play" aria-hidden="true"></i>
                            <audio class="xnine-player track-source-url" src="{{ $track -> preview }}" preload="auto"></audio>
                        </a>
                      </div>
                      <div class="btn-group btn-group-lg">
                        <button type="button" class="btn btn-info"><i class="fa fa-link" aria-hidden="true"></i></button>
                      </div>
                      @if ($track -> track === NULL)
                          <div class="btn-group btn-group-lg">
                            <a href="tracks/{{ $track -> id }}/ChooseUploadFile" class="btn btn-warning">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                            </a>
                          </div>
                        @else
                          <div class="btn-group btn-group-lg">
                            <a href="{{ $track -> id }}/download" class="btn btn-success">
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
                <h1>Upload WAV file</h1>
                <form method='POST' action="{{action('TrackController@UploadFile',['tracks'=>$track->id])}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="TrackInputFile">ADD FILE</label>
                        <input type="file" name="track" id="TrackInputFile">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-md pull-right">UPLOAD</button>
                </div>
                </form>
            </div>
        </div>


    </div>

@endsection
    
