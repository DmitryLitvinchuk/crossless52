@extends('layouts.app')

@section('content')

    <div class="container">

      <div class="page-header">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1>Upload track</h1>
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
            <form method='POST' action="{{action('TrackController@UploadFile',['tracks'=>$track->id])}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="TrackInputFile">Добавить материал</label>
                        <input type="file" name="track" id="TrackInputFile">
                    </div>
                </div>
                <div class="form-group">
                    
                        <button type="submit" class="btn btn-default btn-lg pull-right">добавить</button>
                    
                </div>
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
    
