@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row mt-20">
          <div class="col-lg-12">
                <h1><a href="arparts/drom">DROM.RU</a></h1>
                <h1><a href="arparts/autodoc">Autodoc.ru</a></h1>
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
    
