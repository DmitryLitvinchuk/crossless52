@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <h1>{{ $page_name }}</h1>
              <div class="jumbotron" style="padding:0;">
                  <div class="container-fluid" style="padding:0;">
                    <div class="table-responsive m-0">
                      <table class="table table-hover m-0">
                        <tbody>
                          <tr>
                              <th class="text-center">ID</th>
                              <th class="text-center">Name</th>
                              <th class="text-center">Type</th>
                              <th class="text-center hidden-xs">Points</th>
                          </tr>
                           @foreach ($users as $user)
                            <tr class="text-center track">
                              <td>
                                 <h4 class="mt-20">{{ $user -> id}}</h4>
                              </td>
                              <td>
                                 <h4 class="mt-20">{{ $user -> name}}</h4>
                              </td>
                              <td>
                                 <h4 class="mt-20">{{ $user -> type}}</h4>
                              </td>
                              <td>
                                 <h4 class="mt-20">{{ $user -> points}}</h4>
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
    
