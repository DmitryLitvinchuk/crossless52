@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-25">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <img src="{{ $track -> cover }}" alt="..." class="img-responsive" style="width:100%">
                <div class="btn-group btn-group-justified mt-10 mb-10">
                      <div class="btn-group btn-group-lg">
                        <a href="javascript:void(0)" onclick="aud_play_pause(this)" class="btn btn-default">
                            <i class="control fa fa-play" aria-hidden="true"></i>
                            <audio class="xnine-player" src="{{ $track -> preview }}" preload="auto"></audio>
                        </a>
                      </div>
                        <div class="btn-group btn-group-lg">
                            <a href="https://www.beatport.com/track/track/{{ $track -> top_track_id }}" class="btn btn-info" target="_blank">
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </a>
                        </div>
                        @if ($track -> track !== NULL)
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
                <h2 class="m-0">{{$track -> title }}</h2>
                <p class="text-muted m-0">Remixer:</p>
                <h3 class="m-0">{{$track -> remixer }}</h3>
                <p class="text-muted m-0">Genre:</p>
                <h4 class="m-0">{{$track -> genre }}</h4>
                <p class="text-muted m-0">BPM:</p>
                <h4 class="m-0">{{$track -> bpm }}</h4>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <p class="text-muted m-0">Artist:</p>
                <h2 class="m-0">{{$track -> artist }}</h2>
                <p class="text-muted m-0">Label:</p>
                <h3 class="m-0">{{$track -> label }}</h3>
                <p class="text-muted m-0">Key:</p>
                <h4 class="m-0">{{$track -> key }}</h4>
                <p class="text-muted m-0">Release:</p>
                <h4 class="m-0">{{$track -> release }}</h4>
                @if ($track -> track === NULL)
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
                @else
                <h4 class="m-0 mt-25">If you think that it's wrong WAV file, PUSH THE BUTTON!</h4>
                    <a href="{{ $track -> id }}/wrong" class="btn btn-danger mt-10">WRONG TRACK</a>
                @endif
            </div>
        </div>
       <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h1>
                  Other tracks available for downloading
                  <a href="/newtracks" class="pull-right">all</a>
              </h1>
              <div class="row">
                 @foreach ($tracks as $track)
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="thumbnail p-0 pos-rel">
                      <img class="img-responsive img-100per" src="{{ $track -> cover }}" alt="...">
                      <div class="btn-group btn-group-justified hover mt--22">
                          <div class="btn-group btn-group-xs">
                            <!--<button type="button" class="btn btn-default"><i class="fa fa-play" aria-hidden="true"></i></button>-->
                            <a href="javascript:void(0)" onclick="aud_play_pause(this)" class="btn btn-default">
                                <i class="control fa fa-play" aria-hidden="true"></i>
                                <audio class="xnine-player" src="{{ $track -> preview }}" preload="auto"></audio>
                            </a>
                          </div>
                            <div class="btn-group btn-group-xs">
                                <a href="https://www.beatport.com/track/track/{{ $track -> top_track_id }}" class="btn btn-info" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                           @if ($track -> track === NULL)
                              <div class="btn-group btn-group-xs">
                                <a href="{{ $track -> id }}/ChooseUploadFile" class="btn btn-warning">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </a>
                              </div>
                            @else
                              <div class="btn-group btn-group-xs">
                                <a href="{{ $track -> id }}/download" class="btn btn-success">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                </a>
                              </div>
                            @endif
                     </div>
                     <div class="caption pos-rel">
                        <h4 class="m-0">
                            <a href="{{ $track -> id }}">{{ $track -> title}}</a>
                        </h4>
                        <h6 class="m-0">
                            {{ $track -> artist}}
                        </h6>
                        <h6 class="m-0 hover">
                            <a href="#">{{ $track -> label}}</a>
                        </h6>
                        <h6 class="m-0 hover">
                            <a href="#">{{ $track -> genre}}</a>
                        </h6>
                      </div>
                    </div>
                 </div>
                 @endforeach
              </div>
        </div>

    </div>
       
       <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h1>
                  Other tracks from this label
                  <a href="#" class="pull-right">all</a>
              </h1>
              <div class="row">
                 @foreach ($labeltracks as $labeltrack)
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="thumbnail p-0 pos-rel">
                      <img class="img-responsive img-100per" src="{{ $labeltrack -> cover }}" alt="...">
                      <div class="btn-group btn-group-justified hover mt--22">
                          <div class="btn-group btn-group-xs">
                            <a href="javascript:void(0)" onclick="aud_play_pause(this)" class="btn btn-default">
                                <i class="control fa fa-play" aria-hidden="true"></i>
                                <audio class="xnine-player" src="{{ $labeltrack -> preview }}" preload="auto"></audio>
                            </a>
                          </div>
                            <div class="btn-group btn-group-xs">
                                <a href="https://www.beatport.com/track/track/{{ $labeltrack -> top_track_id }}" class="btn btn-info" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                           @if ($labeltrack -> track === NULL)
                              <div class="btn-group btn-group-xs">
                                <a href="{{ $labeltrack -> id }}/ChooseUploadFile" class="btn btn-warning">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </a>
                              </div>
                            @else
                              <div class="btn-group btn-group-xs">
                                <a href="{{ $labeltrack -> id }}/download" class="btn btn-success">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                </a>
                              </div>
                            @endif
                     </div>
                     <div class="caption pos-rel">
                        <h4 class="m-0">
                            <a href="{{ $labeltrack -> id }}">{{ $labeltrack -> title}}</a>
                        </h4>
                        <h6 class="m-0">
                            {{ $labeltrack -> artist}}
                        </h6>
                        <h6 class="m-0 hover">
                            <a href="#">{{ $labeltrack -> label}}</a>
                        </h6>
                        <h6 class="m-0 hover">
                            <a href="#">{{ $labeltrack -> genre}}</a>
                        </h6>
                      </div>
                    </div>
                 </div>
                 @endforeach
              </div>
        </div>

    </div>

@endsection
    
