@extends('layouts.app')

@section('content')

    <div class="container">

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-header">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>TOP100</h1>
          </div>
          <!-- <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="sponsor">
              <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&serve=C6AILKT&placement=bootswatchcom" id="_carbonads_js"></script>
            </div>
          </div> -->
        </div>
      </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <table class="table table-hover table-responsive">
                <thead>
                  <tr>
                    <th></th>
                    <th class="hidden-xs"></th>
                    <th></th>
                    <th>Title</th>
                    <th>Artists</th>
                    <th>Label</th>
                    <th>Genre</th>
                    <th  class="hidden-xs">Release</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($toptracks as $toptrack)
                        <tr>
                            <td> {{ $toptrack -> top}} </td>
                            <td  class="hidden-xs"> <img src="{{ $toptrack -> track -> cover }}" alt="" class="img-responsive img-34"></td>
                            <td>
                                <a href="javascript:void(0)" onclick="aud_play_pause(this)">
                                    <i class="glyphicon control glyphicon-play-circle"></i>
                                    <audio class="xnine-player" src="{{ $toptrack -> track -> preview }}" preload="auto"></audio>
                                </a>
                            </td>
                            <td> {{ $toptrack -> track -> title}} </td>
                            <td> {{ $toptrack -> track -> artist}} </td>
                            <td> {{ $toptrack -> track -> label}} </td>
                            <td> {{ $toptrack -> track -> genre}} </td>
                            <td> {{ $toptrack -> track -> release}} </td>
                            <td>
                                @if ($toptrack -> track -> track === NULL)
                                    <a href="tracks/{{ $toptrack -> track -> id }}/ChooseUploadFile" class="upload">
                                        <span class="glyphicon glyphicon-upload"></span>
                                    </a>
                                @else
                                <a href="tracks/{{ $toptrack -> track -> id }}/download" class="download">
                                        <span class="glyphicon glyphicon-download"></span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table> 
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
    
