@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-lg-12">
           <h1>Parse from {{ $page_name }}</h1>
            <blockquote>
                <p>
                    This parser can scan pages on {{ $link }} and give some data_
                </p>
            </blockquote>
          </div>
        </div>
        <div class="row mt-20">
          <div class="col-lg-12">
                <form method='POST' action="{{action('PageController@arpartsDromParser')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <div class="form-group">
                        <label class="control-label" for="html">{{ $link }}:</label>
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
    
