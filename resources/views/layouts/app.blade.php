<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CrossLess</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{{ asset('img/favicon.ico') }}}">
    {!! Html::style('css/bootstrap.css') !!}
      {!! Html::style('css/crossless.css') !!}
    {!! Html::style('font-awesome-4.7.0/css/font-awesome.min.css') !!}
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top navbar-shadow">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand p-10"><img class="img-responsive" src="{{ URL::asset('img/kross.png') }}" alt="..." style="width:55px;"></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <!-- <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Genres <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="../default/">Default</a></li>
                <li class="divider"></li>
                <li><a href="../cerulean/">Cerulean</a></li>
                <li><a href="../cosmo/">Cosmo</a></li>
                <li><a href="../cyborg/">Cyborg</a></li>
                <li><a href="../darkly/">Darkly</a></li>
                <li><a href="../flatly/">Flatly</a></li>
                <li><a href="../journal/">Journal</a></li>
                <li><a href="../lumen/">Lumen</a></li>
                <li><a href="../paper/">Paper</a></li>
                <li><a href="../readable/">Readable</a></li>
                <li><a href="../sandstone/">Sandstone</a></li>
                <li><a href="../simplex/">Simplex</a></li>
                <li><a href="../slate/">Slate</a></li>
                <li><a href="../spacelab/">Spacelab</a></li>
                <li><a href="../superhero/">Superhero</a></li>
                <li><a href="../united/">United</a></li>
                <li><a href="../yeti/">Yeti</a></li>
              </ul>
            </li> -->
            <li>
              <a href="/newtracks">New tracks</a>
            </li>
            <li>
              <a href="/top">Top100</a>
            </li>
            <li>
              <a href="/addnewtrack/">Add New Track</a>
            </li>
            <li>
              <a href="/about">About</a>
            </li>
          </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/earnpoints') }}">{{ Auth::user()->points }} points</a></li>
                    @if (Auth::user()->type === 'admin')
                        <li><a href="{{ url('/toptrack') }}" class="warning">Refresh Top100</a></li>
                    @endif
                @endif
            </ul>

        </div>
      </div>
    </div>
    @include('flash::message')
    
    @yield('content')
 
    <div class="navbar-bottom">
      <div class="navbar-inner">
          <div class="container">
           <div class="row">
               <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <a href="/"><img class="img-responsive w-104 mt-10 center-block" src="img/kross.png" alt="..."></a>
                   <h6 class="hidden-xs text-center mt-8 mb-10"><a href="#">2017 <i class="fa fa-copyright" aria-hidden="true"></i> CROSSLESS</a></h6>
                   <h6 class="visible-xs text-center">support@crossless.club</h6>
               </div>
               <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                   <h4 class="mt-20 text-center">Happy People</h4>
                   <h5 class="text-center"><a href="#">14000 accounts</a></h5>
                   <h5 class="text-center"><a href="#">3745 tracks</a></h5>
               </div>
               <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                   <h4 class="mt-25 text-center">We are social</h4>
                   <h3 class="text-center mt-10">
                       <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                       <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
                       <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                   </h3>
               </div>
               <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                   <h4 class="mt-25 text-center">Collaboration & Info</h4>
                   <h6 class="text-center">support@crossless.club</h6>
               </div>
           </div>
          </div>
      </div>
    </div>
    <script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script>
    function aud_play_pause(object) {
        var myAudio = object.querySelector(".xnine-player");
        var myIcon = object.querySelector(".control");
        if (myAudio.duration > 0 && !myAudio.paused) {
            myIcon.className = "control fa fa-play";
            myAudio.pause();            
        } else {
            myIcon.className = "control fa fa-pause";
            myAudio.play();              
        }
        /*
        if (myAudio.paused) {
            myIcon.className = "control fa fa-play";
            myAudio.play();
        } else {
            myIcon.className = "control fa fa-refresh";
            myAudio.pause();
        } */
        $("audio").on("play", function() {
            $("audio").not(this).each(function(index, audio) {
                audio.pause();
            });
        });
    }
</script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
      @yield('scripts')
      
      
    <!-- Modal Alerts -->
    <div id="modalAlert" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-xs-12"><p></p></div>
              </div>
          </div>
          <div class="modal-footer text-right">
            <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>
