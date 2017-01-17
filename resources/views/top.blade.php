@extends('layouts.app')

@section('content')

    <div class="container">

      <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 page-header">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>TOP100</h1>
          </div>
           <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="sponsor">
              <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&serve=C6AILKT&placement=bootswatchcom" id="_carbonads_js"></script>
            </div>
          </div> 
        </div>
      </div>-->

        <!--<div class="row">
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
                            <td> 
                                <a href="tracks/{{ $toptrack -> track -> id }}">
                                    {{ $toptrack -> track -> title}} 
                                </a>
                            </td>
                            <td> {{ $toptrack -> track -> artist}} </td>
                            <td> {{ $toptrack -> track -> label}} </td>
                            <td> {{ $toptrack -> track -> genre}} </td>
                            <td> {{ $toptrack -> track -> release}} </td>
                            <td>
                                @if ($toptrack -> track -> track === NULL)
                                    <a href="tracks/{{ $toptrack -> track -> id }}/ChooseUploadFile" class="upload">
                                        <span class="fa fa-upload" aria-hidden="true"></span>
                                    </a>
                                @else
                                <a href="tracks/{{ $toptrack -> track -> id }}/download" class="download">
                                        <span class="fa fa-download" aria-hidden="true"></span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table> 
          </div>
        </div>-->
        
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <h1>TOP100 Tracks</h1>
              <div class="jumbotron" style="padding:0;">
                  <div class="container-fluid" style="padding:0;">
                    <div class="table-responsive m-0">
                      <table class="table table-hover m-0">
                        <tbody>
                          <tr>
                              <th></th>
                              <th></th>
                              <th class="hidden-xs"></th>
                              <th class="text-center">Title</th>
                              <th class="text-center">Artist</th>
                              <th class="text-center">Genre</th>
                              <th class="text-center hidden-xs">Speed</th>
                              <th class="text-center hidden-xs">Label</th>
                              <th class="text-center hidden-xs">Release</th>
                              <th></th>
                          </tr>
                           @foreach ($toptracks as $toptrack)
                            <tr class="text-center">
                              <td>
                                 <h4 class="mt-20">{{ $toptrack -> top}}</h4>
                              </td>
                              <td class="w-74">
                                  
                                    <a href="javascript:void(0)" onclick="aud_play_pause(this)">
                                        <h4 class="mt-20">
                                          <i class="control fa fa-play" aria-hidden="true"></i>
                                        </h4>
                                        <audio class="xnine-player" src="{{ $toptrack -> track -> preview }}" preload="auto"></audio>
                                    </a>
                              </td>
                              <td class="p-0 hidden-xs w-74">
                                  <img src="{{ $toptrack -> track -> cover }}" alt="..." class="img-responsive img-74">
                              </td>
                              <td class="hidden-xs">
                                  <h5 class="mt-22"><a href="tracks/{{ $toptrack -> track -> id }}">{{ $toptrack -> track -> title}}</a></h5>
                              </td>
                              <td class="visible-xs">
                                  <h5 class="mt-22"><a href="#">{{ $toptrack -> track -> title}}</a></h5>
                              </td>
                              <td>
                                  <h5 class="mt-22"><a href="#">{{ $toptrack -> track -> artist}}</a></h5>
                              </td>
                              <td>
                                  <h6 class="mt-25"><a href="#">{{ $toptrack -> track -> genre}}</a></h6>
                              </td>
                              <td class="hidden-xs">
                                  <h6 class="mt-25">{{ $toptrack -> track -> bpm}}</h6>
                              </td>
                              <td class="hidden-xs">
                                  <h5 class="mt-22"><a href="#">{{ $toptrack -> track -> label}}</a></h5>
                              </td>
                              <td class="hidden-xs w-74">
                                  <h6 class="mt-25">{{ $toptrack -> track -> release}}</h6>
                              </td>
                              <td class="w-74 text-center">
                                @if ($toptrack -> track -> track === NULL)
                                    <a href="tracks/{{ $toptrack -> track -> id }}" class="upload">
                                        <h4 class="mt-20">
                                          <i class="fa fa-upload fa-warning" aria-hidden="true"></i>
                                      </h4>
                                    </a>
                                @else
                                    <a href="tracks/{{ $toptrack -> track -> id }}/download" class="download">
                                        <h4 class="mt-20">
                                          <i class="fa fa-download fa-success" aria-hidden="true"></i>
                                      </h4>
                                    </a>
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
    
