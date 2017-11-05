@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
              <h1>
                  Tracks from Soundcloud
              </h1>
              <div class="row">
                 @foreach ($customtracks as $customtrack)
                 <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="thumbnail p-0 pos-rel track">
                      <img class="img-responsive img-100per track-image" src="{{ $customtrack -> cover }}" alt="...">
                      <div class="btn-group btn-group-justified hover mt--22">
                     </div>
                     <div class="caption pos-rel">
                        <h4 class="m-0">
                            <a href="customtracks/{{ $customtrack -> id }}" class="track-title">{{ $customtrack -> title }}</a>
                        </h4>
                        <h6 class="m-0 track-author">
                            {{ $customtrack -> artist}}
                        </h6>
                      </div>
                    </div>
                 </div>
                 @endforeach
              </div>
        </div>
      </div>
    </div>

@endsection