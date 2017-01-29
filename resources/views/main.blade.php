@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <h1>
                  New Tracks
                  <a href="/newtracks" class="pull-right">all</a>
              </h1>
              <div class="row">
                 @foreach ($tracks as $track)
                  <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
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
                            <a href="tracks/{{ $track -> id }}" class="track-title">{{ $track -> title}}</a>
                        </h4>
                        <h6 class="m-0 track-author">
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
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
             <h1> 
                 Top100
                 <a href="/top" class="pull-right">all</a>
             </h1>
              <div class="jumbotron" style="padding:0;">
                  <div class="container-fluid" style="padding:0;">
                    <div class="table-responsive m-0">
                      <table class="table table-hover m-0">
                        <tbody>
                           @foreach ($toptracks as $toptrack)
                            <tr class="track">
                              <td class="text-center">
                                 <h4 class="mt-20">{{ $toptrack -> top}}</h4>
                              </td>
                              <td class="text-center">
                                  <a href="javascript:void(0)" data-id="{{ $toptrack -> id }}" onclick="aud_play_pause(this)">
                                        <h4 class="mt-20">
                                          <i class="control fa fa-play" aria-hidden="true"></i>
                                        </h4>
                                        <audio class="xnine-player track-source-url" src="{{ $toptrack -> track -> preview }}" preload="auto"></audio>
                                    </a>
                              </td>
                              <td class="p-0 hidden-xs w-74">
                                  <img src="{{ $toptrack -> track -> cover }}" alt="..." class="img-responsive img-74 track-image">
                              </td>

                              <td>
                                  <h5 class="mt-10"><a class="track-title" href="tracks/{{ $toptrack -> track -> id }}">{{ $toptrack -> track -> title}}</a></h5>
                                  <h6 class="mt-0 track-author">{{ $toptrack -> track -> artist}}</h6>
                              </td>
                              <td class="text-center">
                                  @if ($toptrack -> track -> track === NULL)
                                        <a href="tracks/{{ $toptrack -> track -> id }}" class="upload track-link">
                                            <h4 class="mt-20">
                                              <i class="fa fa-upload fa-warning" aria-hidden="true"></i>
                                          </h4>
                                        </a>

                                    @else
                                        @if ($track -> inspection !== 0)
                                            <a href="tracks/{{ $toptrack -> track -> id }}/download" class="download track-link">
                                                <h4 class="mt-20">
                                                  <i class="fa fa-download fa-success" aria-hidden="true"></i>
                                              </h4>
                                            </a>
                                        @else
                                            <a href="tracks/{{ $toptrack -> track -> id }}/download" class="download track-link" data-toggle="tooltip" title="This track has not been checked!">
                                                <h4 class="mt-20">
                                                  <i class="fa fa-download fa-warning" aria-hidden="true"></i>
                                                </h4>
                                            </a>
                                        @endif
                                    @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
          </div>
      </div>

    </div>

@endsection
    
