@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection


@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>
                  {{ $page_name }}
                  <a href="/soundcloudtracks/addnewtrack/">upload your track</a>
              </h1>
              <div class="row">
                 @foreach ($soundcloudtracks as $soundcloudtrack)
                  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="thumbnail p-0 pos-rel track">
                      <img class="img-responsive img-100per track-image" src="{{ $soundcloudtrack -> cover }}" alt="...">
                      <div class="btn-group btn-group-justified hover mt--22">
                          <div class="btn-group btn-group-xs">
                            <!--<button type="button" class="btn btn-default"><i class="fa fa-play" aria-hidden="true"></i></button>-->
                             <a href="{{ $soundcloudtrack -> link }}" class="btn btn-default track-link " target="_blank">
                                    <i class="fa fa-link" aria-hidden="true"></i>
							</a>
                          </div>
                           @if ($soundcloudtrack -> track === NULL)
                              <div class="btn-group btn-group-xs">
                                <a href="tracks/{{ $soundcloudtrack -> id }}/ChooseUploadFile" class="btn btn-warning track-link">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </a>
                              </div>
                            @else
                                @if ($soundcloudtrack -> inspection !== 0)
                                    <div class="btn-group btn-group-xs">
                                      <a href="tracks/{{ $soundcloudtrack -> id }}/download" class="btn btn-success">
                                          <i class="fa fa-download" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                @else
                                    <div class="btn-group btn-group-xs">
                                      <a href="{{ $soundcloudtrack -> id }}/download" class="btn btn-default" data-toggle="tooltip" title="This track has not been checked!">
                                          <i class="fa fa-download" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                @endif
                            @endif
                     </div>
                     <div class="caption pos-rel">
                        <h4 class="m-0">
                            <a href="soundcloudtracks/{{ $soundcloudtrack -> id }}" class="track-title">{{ $soundcloudtrack -> title}}</a>
                        </h4>
                        <h6 class="m-0 track-author">
                            {{ $soundcloudtrack -> artist}}
                        </h6>
                        <h6 class="m-0 hover">
                            <a href="genres/{{ $soundcloudtrack -> genre}}">{{ $soundcloudtrack -> genre}}</a>
                        </h6>
                      </div>
                    </div>
                 </div>
                 @endforeach
              </div>
              <?php echo $soundcloudtracks->render(); ?>
        </div>
      </div>

    </div>

@endsection
    
