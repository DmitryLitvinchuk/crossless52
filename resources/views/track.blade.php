@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="page-header">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>{{$track -> title }}</h1>
          </div>
          <!-- <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="sponsor">
              <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&serve=C6AILKT&placement=bootswatchcom" id="_carbonads_js"></script>
            </div>
          </div> -->
        </div>
      </div>
        
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-4 col-lg-3">
                <img class="img-responsive" src="{{ $track -> cover }}" alt="Chania">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-6">
                <p class="text-muted m-0">TRACK</p>
                <h2 class="mt-0">
                    <a href="javascript:void(0)" onclick="aud_play_pause(this)">
                        <i class="glyphicon control glyphicon-play-circle"></i>
                        <audio class="xnine-player" src="{{$track -> preview}}" preload="auto"></audio>
                    </a>
                    {{$track -> title }}
                    <p class="text-muted ml-10">({{ $track -> remixer }})</p>
                </h2>
                <p class="text-muted m-0">ARTIST</p>
                <h2 class="mt-0">
                    {{ $track -> artist }}
                </h2>
                <p class="text-muted m-0">GENRE</p>
                <h3 class="mt-0">
                    {{ $track -> genre }}
                </h3>
                <p class="text-muted m-0">RELEASE</p>
                <h4 class="mt-0">
                    {{ $track -> release }}
                </h4>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <p class="text-muted m-0">AVAILABILITY</p>
                <h2 class="mt-0">
                    @if ($track -> track === NULL)
                        <a href="tracks/{{ $track -> id }}/ChooseUploadFile" class="upload">
                            <span class="glyphicon glyphicon-upload"></span>
                        </a>
                        UPLOAD TRACK
                    @else
                        <a href="{{ $track -> id }}/download" class="download">
                            <span class="glyphicon glyphicon-download"></span>
                        </a>
                        DOWNLOAD TRACK
                    @endif
                </h2>
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
    
