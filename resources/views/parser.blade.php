@extends('layouts.app')

@section('content')

    <div class="container">

      <div class="page-header">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>Find track</h1>
          </div>
          <!-- <div class="col-lg-4 col-md-5 col-sm-6">
            <div class="sponsor">
              <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?zoneid=1673&serve=C6AILKT&placement=bootswatchcom" id="_carbonads_js"></script>
            </div>
          </div> -->
        </div>
      </div>

        <div class="row">
          <div class="col-lg-12">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th class="hidden-xs"></th>
                    <th></th>
                    <th>Title</th>
                    <th>Remixer</th>
                    <th>Artists</th>
                    <th>Label</th>
                    <th>Genre</th>
                    <th  class="hidden-xs">Release</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td  class="hidden-xs"> <img src="{{ $track -> cover }}" alt="" class="img-responsive img-34"></td>
                    <td>
                        <a href="#">
                            <span class="glyphicon glyphicon-play-circle"></span>
                        </a>
                    </td>
                    <td> {{ $track -> title }} </td>
                    <td> {{ $track -> remixer }} </td>
                    <td>{{ $track -> artist }}</td>
                    <td>{{ $track -> label }}</td>
                    <td>{{ $track -> genre }}</td>
                    <td  class="hidden-xs">{{ $track -> release }}</td>
                    <td>
                        <a href="#" class="upload">
                            <span class="glyphicon glyphicon-upload"></span>
                        </a>
                    </td>
                  </tr>
                    {!! Form::open([
                        'method' => 'DELETE',
                        'action' => ['TrackController@destroy', $track->id]
                    ]) !!}
                    {!! Form::submit('Cancel', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                <a type="button" class="btn btn-success" href="/">Add</a>
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
    
