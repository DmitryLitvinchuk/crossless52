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
              {!! Form::open(array('url' => 'find', 'method' => 'post')) !!}
                {!! Form::label('html', 'Beatport:', ['class' => 'control-label']) !!}
                {!! Form::text('html', null, ['class' => 'form-control']) !!}
              {!! Form::submit('Найти', ['class' => 'btn btn-default btn-md pull-right']) !!}
                {!! Form::close() !!}
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
    
