@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-25 track">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <img src="{{ $track -> cover }}" alt="..." class="img-responsive track-image" style="width:100%">
                <div class="btn-group btn-group-justified mt-10 mb-10">
                      <div class="btn-group btn-group-lg">
                        <a href="javascript:void(0)" data-id="{{ $track -> id }}" onclick="aud_play_pause(this)" class="btn btn-default">
                            <i class="control fa fa-play" aria-hidden="true"></i>
                            <audio class="xnine-player track-source-url" src="{{ $track -> preview }}" preload="auto"></audio>
                        </a>
                      </div>
                        <div class="btn-group btn-group-lg">
                            <a href="https://www.beatport.com/track/track/{{ $track -> top_track_id }}" class="btn btn-info track-link" target="_blank">
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </a>
                        </div>
                        @if ($track -> track !== NULL)
                            @if ($track -> inspection !== 0)
                                <div class="btn-group btn-group-lg">
                                  <a href="{{ $track -> id }}/download" class="btn btn-success">
                                      <i class="fa fa-download" aria-hidden="true"></i>
                                  </a>
                                </div>
                            @else
                                <div class="btn-group btn-group-lg">
                                  <a href="{{ $track -> id }}/download" class="btn btn-default" data-toggle="tooltip" title="This track has not been checked!">
                                      <i class="fa fa-download" aria-hidden="true"></i>
                                  </a>
                                </div>
                            @endif
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
                @if ($track -> track !== NULL)
                    @if (Auth::user()->type === 'admin')
                        <p class="text-muted m-0">User:</p>
                        <h4 class="m-0">{{$track -> user_id }}</h4>
                        <p class="text-muted m-0">Time:</p>
                        <h4 class="m-0">{{$track -> updated_at }}</h4>
                    @endif
                    <p class="text-muted m-0">INSPECTION:</p>
                    @if ($track -> inspection === 0)
                        <h4 class="m-0">CHECKING <i class="fa warning fa-clock-o" aria-hidden="true"></i></h4>
                        @if (Auth::user()->type === 'admin')
                                <a href="{{ $track -> id }}/accept" class="btn btn-success mt-10">ACCEPT TRACK</a>
                                <a href="{{ $track -> id }}/delete" class="btn btn-warning mt-10">DELETE TRACK</a>
                        @endif
                    @else
                        <h4 class="m-0">CHECKED <i class="fa success fa-success fa-check" aria-hidden="true"></i></h4>
                        @if (Auth::user()->type === 'admin')
                            @if ($track -> wrong !== 0)
                                <a href="{{ $track -> id }}/reaccept" class="btn btn-success mt-10">REACCEPT TRACK</a>
                            @endif
                            <a href="{{ $track -> id }}/delete" class="btn btn-warning mt-10">DELETE TRACK</a>
                            <a href="{{ $track -> id }}/changes" class="btn btn-info mt-10">CHANGES</a>
                        @endif
                    @endif
                @endif
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
                            <button type="submit" class="btn btn-warning btn-md pull-right" id="TrackSubmit">UPLOAD</button>
                            <!--<button class="btn btn-warning btn-md pull-right" id="TrackSubmit">UPLOAD TRACK</button>-->
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
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 track">
                    <div class="thumbnail p-0 pos-rel">
                      <img class="img-responsive img-100per track-image" src="{{ $track -> cover }}" alt="...">
                      <div class="btn-group btn-group-justified hover mt--22">
                          <div class="btn-group btn-group-xs">
                            <!--<button type="button" class="btn btn-default"><i class="fa fa-play" aria-hidden="true"></i></button>-->
                            <a href="javascript:void(0)" data-id="{{ $track -> id }}" onclick="aud_play_pause(this)" class="btn btn-default">
                                <i class="control fa fa-play" aria-hidden="true"></i>
                                <audio class="xnine-player track-source-url" src="{{ $track -> preview }}" preload="auto"></audio>
                            </a>
                          </div>
                            <div class="btn-group btn-group-xs">
                                <a href="https://www.beatport.com/track/track/{{ $track -> top_track_id }}" class="btn btn-info" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                           @if ($track -> track === NULL)
                              <div class="btn-group btn-group-xs">
                                <a href="{{ $track -> id }}/ChooseUploadFile" class="btn btn-warning track-link">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </a>
                              </div>
                            @else
                                @if ($track -> track !== NULL)
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
                            @endif
                     </div>
                     <div class="caption pos-rel">
                        <h4 class="m-0">
                            <a href="{{ $track -> id }}" class="track-title">{{ $track -> title}}</a>
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

    </div>
       
       <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <h1>
                  Other tracks from this label
                  <a href="../{{ $link_label }}" class="pull-right">all</a>
              </h1>
              <div class="row">
                 @foreach ($labeltracks as $labeltrack)
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 track">
                    <div class="thumbnail p-0 pos-rel">
                      <img class="img-responsive img-100per track-image" src="{{ $labeltrack -> cover }}" alt="...">
                      <div class="btn-group btn-group-justified hover mt--22">
                          <div class="btn-group btn-group-xs">
                            <a href="javascript:void(0)" data-id="{{ $labeltrack -> top_track_id }}" onclick="aud_play_pause(this)" class="btn btn-default track-source-url">
                                <i class="control fa fa-play" aria-hidden="true"></i>
                                <audio class="xnine-player track-source-url" src="{{ $labeltrack -> preview }}" preload="auto"></audio>
                            </a>
                          </div>
                            <div class="btn-group btn-group-xs">
                                <a href="https://www.beatport.com/track/track/{{ $labeltrack -> top_track_id }}" class="btn btn-info track-link" target="_blank">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                           @if ($labeltrack -> track === NULL)
                              <div class="btn-group btn-group-xs">
                                <a href="{{ $labeltrack -> id }}/ChooseUploadFile" class="btn btn-warning track-link">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </a>
                              </div>
                            @else
                                @if ($track -> track !== NULL)
                                    @if ($labeltrack -> inspection !== 0)
                                        <div class="btn-group btn-group-xs">
                                          <a href="{{ $labeltrack -> id }}/download" class="btn btn-success">
                                              <i class="fa fa-download" aria-hidden="true"></i>
                                          </a>
                                        </div>
                                    @else
                                        <div class="btn-group btn-group-xs">
                                          <a href="{{ $labeltrack -> id }}/download" class="btn btn-default" data-toggle="tooltip" title="This track has not been checked!">
                                              <i class="fa fa-download" aria-hidden="true"></i>
                                          </a>
                                        </div>
                                    @endif
                                @endif
                            @endif
                     </div>
                     <div class="caption pos-rel">
                        <h4 class="m-0">
                            <a href="{{ $labeltrack -> id }}" class="track-title">{{ $labeltrack -> title}}</a>
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
        
@section('scripts')
        <script>
            /*
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            function uploadTrack() {
                
                var request = $.ajax({
                    url: "{{action('TrackController@UploadFile',['tracks'=>$track->id])}}",
                    method: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false
                });
                
                request.success(function (data) {
                    console.log(data);
                    $("#modalAlert").modal("show");
                    $('#modalAlert').find("p").text('Файл успешно загружен!');
                    $('#modalAlert').find();
                    
                    //window.location.href = data.redirect;
                });
                
                request.error(function (data) {
                    $("#modalAlert").modal("show");
                    $('#modalAlert').find("p").text('Произошла ошибка!');
                    console.log(data);
                });
            }
            */
            
            formdata = new FormData();  
            $("#TrackInputFile").on("change", function() {
                var this_ = $(this);
                // get the file name, possibly with path (depends on browser)
                var filename = this_.val();

                // Use a regular expression to trim everything before final dot
                var extension = filename.replace(/^.*\./, '');

                // Iff there is no dot anywhere in filename, we would have extension == filename,
                // so we account for this possibility now
                if (extension == filename) {
                    extension = '';
                } else {
                    // if there is an extension, we convert to lower case
                    // (N.B. this conversion will not effect the value of the extension
                    // on the file upload.)
                    extension = extension.toLowerCase();
                }
            
                if (extension != 'wav') {
                    $("#modalAlert").modal("show");
                    $('#modalAlert').find(".modal-title").text('Error');
                    $('#modalAlert').find("p").text('This is a not wav file!');
                    this_.replaceWith(this_.val('').clone(true));
                }
                var file = this.files[0];
                    if (formdata) {
                        formdata.append("track", file);
                    }
            });
        
            /*
            $("#TrackSubmit").on("click", function() {
                uploadTrack();
            }); */
        </script>
@endsection
    
