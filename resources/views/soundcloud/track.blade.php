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
                <p class="text-muted m-0">Artist:</p>
                <h2 class="m-0 track-author">{{$soundcloudtrack -> artist }}</h2>
                <p class="text-muted m-0">Genre:</p>
                <h4 class="m-0">{{$soundcloudtrack -> genre }}</h4>
                <p class="text-muted m-0">Release:</p>
                <h4 class="m-0">{{$soundcloudtrack -> release }}</h4>
                @if ($soundcloudtrack -> track !== NULL)
                    @if (Auth::user()->type === 'admin')
                        <p class="text-muted m-0">User:</p>
                        <h4 class="m-0">{{$soundcloudtrack -> user_id }}</h4>
                        <p class="text-muted m-0">Email:</p>
                        <h4 class="m-0">{{$soundcloudtrack -> email }}</h4>
                        <p class="text-muted m-0">Time:</p>
                        <h4 class="m-0">{{$soundcloudtrack -> updated_at }}</h4>
                    @endif
                    <p class="text-muted m-0">INSPECTION:</p>
                    @if ($soundcloudtrack -> inspection === 0)
                        <h4 class="m-0">CHECKING <i class="fa warning fa-clock-o" aria-hidden="true"></i></h4>
                        @if (Auth::user()->type === 'admin' or Auth::user()->type === 'checker')
                                <a href="{{ $soundcloudtrack -> id }}/accept" class="btn btn-success mt-10">ACCEPT TRACK</a>
                                <a href="{{ $soundcloudtrack -> id }}/edit" class="btn btn-warning mt-10">EDIT TRACK</a>
                        @endif
                    @else
                        <h4 class="m-0">CHECKED <i class="fa success fa-success fa-check" aria-hidden="true"></i></h4>
                        @if (Auth::user()->type === 'admin')
                                <a href="{{ $soundcloudtrack -> id }}/edit" class="btn btn-warning mt-10">EDIT TRACK</a>    
                        @endif
                    @endif
                @endif
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                @if ($soundcloudtrack -> track === NULL)
                    <h1>Upload WAV file</h1>
                    <form method='POST' action="{{action('SoundcloudController@Upload',['soundcloudtracks'=>$soundcloudtrack->id])}}" enctype="multipart/form-data">
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
                @endif
                @if ($soundcloudtrack -> track !== NULL)
						@if (Auth::user()->type === 'admin')
								<a href="{{ $soundcloudtrack -> id }}/delete" class="btn btn-danger mt-10 pull-right">DELETE TRACK</a>
						@endif
				@endif
            </div>
        </div>
    </div>

@endsection
    
