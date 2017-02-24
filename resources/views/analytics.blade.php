@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
              <h1>
                  {{ $page_name }}
              </h1>
              <div class="row">
                <h2>
                  Amount of tracks: {{ $number_of_tracks }}
                </h2>
                <h2>
                  Checked tracks: {{ $checked_tracks }}
                </h2>
                <h2>
                  Users: {{ $number_of_users }}
                </h2>
              </div>
        </div>
      </div>

    </div>

@endsection
    
