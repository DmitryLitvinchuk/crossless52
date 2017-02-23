@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-lg-12">
           <h1>Add Track</h1>
            <blockquote>
                <p>
                    If you have not found a track on CrossLess, but you wanna add it. 
                    Paste link to this track in Beatport into this field.
                </p>
                <small>Link should be something like that <cite class="text-primary" title="Source Title">https://www.beatport.com/track/learning-to-fall-petar-dundov-remix/8762114</cite></small>
            </blockquote>
          </div>
        </div>
        <div class="row mt-20">
          <div class="col-lg-12">
                <form method='POST' action="{{action('TrackController@create')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <div class="form-group">
                        <label class="control-label" for="html">Beatport:</label>
                        <input class="form-control" id="html" name="html" type="text">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-md pull-right">FIND</button>
                    </div>
                    <a href="/" class="btn btn-default">CANCEL</a>
                </form>
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
    
