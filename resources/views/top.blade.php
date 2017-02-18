@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
@endsection

@section('content')

    <div class="container">
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
                            <tr class="text-center track">
                              <td>
                                 <h4 class="mt-20">{{ $toptrack -> top}}</h4>
                              </td>
                              <td class="w-74">
                                  
                                    <a href="javascript:void(0)" onclick="aud_play_pause(this)" data-id="{{ $toptrack -> track -> id }}">
                                        <h4 class="mt-20">
                                          <i class="control fa fa-play" aria-hidden="true"></i>
                                        </h4>
                                        <audio class="xnine-player track-source-url" src="{{ $toptrack -> track -> preview }}" preload="auto"></audio>
                                    </a>
                              </td>
                              <td class="p-0 hidden-xs w-74">
                                  <img src="{{ $toptrack -> track -> cover }}" alt="..." class="img-responsive img-74 track-image">
                              </td>
                              <td class="hidden-xs">
                                  <h5 class="mt-22"><a href="tracks/{{ $toptrack -> track -> id }}">{{ $toptrack -> track -> title}}</a></h5>
                              </td>
                              <td class="visible-xs">
                                  <h5 class="mt-22 track-title"><a href="#">{{ $toptrack -> track -> title}}</a></h5>
                              </td>
                              <td>
                                  <h5 class="mt-22 track-author"><a href="#">{{ $toptrack -> track -> artist}}</a></h5>
                              </td>
                              <td>
                                <h6 class="mt-25">
                                    @if ($toptrack -> track -> genre === 'Indie Dance / Nu Disco')
                                        <a href="genre/indie-dance-nu-disco">{{ $toptrack -> track -> genre}}</a>
                                    @elseif($toptrack -> track -> genre === 'Drum &amp; Bass')
                                        <a href="genre/drum-bass">{{ $toptrack -> track -> genre}}</a>
                                    @elseif($toptrack -> track -> genre === 'Electronica / Downtempo')
                                        <a href="genre/electronica-downtempo">{{ $toptrack -> track -> genre}}</a>
                                    @elseif($toptrack -> track -> genre === 'Hardcore / Hard Techno')
                                        <a href="genre/hardcore-hard-techno">{{ $toptrack -> track -> genre}}</a>
                                    @elseif($toptrack -> track -> genre === 'Hardcore / Hard Techno')
                                        <a href="genre/hardcore-hard-techno">{{ $toptrack -> track -> genre}}</a>
                                    @else
                                        <a href="genres/{{ $toptrack -> track -> genre}}">{{ $toptrack -> track -> genre}}</a>
                                    @endif
                                </h6>
                              </td>
                              <td class="hidden-xs">
                                  <h6 class="mt-25">{{ $toptrack -> track -> bpm}}</h6>
                              </td>
                              <td class="hidden-xs">
                                <h5 class="mt-22">
                                    @if ($toptrack -> track -> label === 'Spinnin&#39; Remixes')
                                        <a href="label/spinnin">{{ $toptrack -> track -> label}}</a>
                                    @elseif($toptrack -> track -> label === 'SPINNIN&#39; RECORDS')
                                        <a href="label/spinnin">{{ $toptrack -> track -> label}}</a>
                                    @elseif($toptrack -> track -> label === 'SPRS')
                                        <a href="label/spinnin">{{ $toptrack -> track -> label}}</a>
                                    @elseif($toptrack -> track -> label === "SPINNIN'%20DEEP")
                                        <a href="label/spinnin">{{ $toptrack -> track -> label}}</a>
                                    @else
                                        <a href="labels/{{ $toptrack -> track -> label}}">{{ $toptrack -> track -> label}}</a>
                                    @endif  
                                </h5>
                              </td>
                              <td class="hidden-xs w-74">
                                  <h6 class="mt-25">{{ $toptrack -> track -> release}}</h6>
                              </td>
                              <td class="w-74 text-center">
                                @if ($toptrack -> track -> track === NULL)
                                    <a href="tracks/{{ $toptrack -> track -> id }}" class="upload track-link">
                                        <h4 class="mt-20">
                                          <i class="fa fa-upload fa-warning" aria-hidden="true"></i>
                                      </h4>
                                    </a>
                                @else
                                    @if ($toptrack -> track -> inspection !== 0)
                                        <a href="tracks/{{ $toptrack -> track -> id }}/download" class="download track-link">
                                            <h4 class="mt-20">
                                              <i class="fa fa-download success" aria-hidden="true"></i>
                                          </h4>
                                        </a>
                                    @else
                                        <a href="tracks/{{ $toptrack -> track -> id }}/download" class="download track-link" data-toggle="tooltip" title="This track has not been checked!">
                                            <h4 class="mt-20">
                                              <i class="fa fa-download gray" aria-hidden="true"></i>
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
    
