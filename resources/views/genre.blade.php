@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h1>
                  {{ $page_name }}
              </h1>
              <div class="row">
                 @foreach ($tracks as $track)
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <div class="thumbnail p-0 pos-rel track">
                      <img class="img-responsive img-100per track-image" src="{{ $track -> cover }}" alt="...">
                      <div class="btn-group btn-group-justified hover mt--22">
                          <div class="btn-group btn-group-xs">
                            <!--<button type="button" class="btn btn-default"><i class="fa fa-play" aria-hidden="true"></i></button>-->
                            <a href="javascript:void(0)" onclick="aud_play_pause(this)" class="btn btn-default" data-id="{{ $track -> top_track_id }}">
                                <i class="control fa fa-play" aria-hidden="true"></i>
                                <audio class="xnine-player track-source-url" src="{{ $track -> preview }}" preload="auto"></audio>
                            </a>
                          </div>
                            <div class="btn-group btn-group-xs">
                                <a href="https://www.beatport.com/track/track/{{ $track -> top_track_id }}" class="btn btn-info track-source-url" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                           @if ($track -> track === NULL)
                              <div class="btn-group btn-group-xs">
                                <a href="tracks/{{ $track -> id }}/ChooseUploadFile" class="btn btn-warning track-link">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </a>
                              </div>
                            @else
                                @if ($track -> inspection !== 0)
                                    <div class="btn-group btn-group-xs">
                                      <a href="{{ $track -> id }}/download" class="btn btn-success">
                                          <i class="fa fa-download" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                @else
                                    <div class="btn-group btn-group-xs">
                                      <a href="{{ $track -> id }}/download" class="btn btn-default" data-toggle="tooltip" title="This track has not been checked!">
                                          <i class="fa fa-download" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                @endif
                            @endif
                     </div>
                     <div class="caption pos-rel">
                        <h4 class="m-0">
                            <a href="../tracks/{{ $track -> id }}" class="track-title">{{ $track -> title}}</a>
                        </h4>
                        <h6 class="m-0 track-author">
                            {{ $track -> artist}}
                        </h6>
                        <h6 class="m-0 hover">
                            <a href="#">{{ $track -> label}}</a>
                        </h6>
                        <h6 class="m-0 hover">
                            <a href="{{ $track -> genre}}">{{ $track -> genre}}</a>
                        </h6>
                      </div>
                    </div>
                 </div>
                 @endforeach
                 
              </div>
              <?php echo $tracks->render(); ?>
        </div>
      </div>

    </div>

@endsection
    
