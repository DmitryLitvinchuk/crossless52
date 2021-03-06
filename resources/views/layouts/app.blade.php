<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    {!! Html::style('css/bootstrap.css') !!}
      {!! Html::style('css/crossless.css') !!}
    {!! Html::style('font-awesome-4.7.0/css/font-awesome.min.css') !!}
    {!! Analytics::render() !!}
    <!-- Scripts -->
    
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
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
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Genres <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('genres/big-room') }}">Big Room</a></li>
                    <li><a href="{{ url('genres/breaks') }}">Breaks </a></li>
                    <li><a href="{{ url('genres/deep-house') }}">Deep House</a></li>
                    <li><a href="{{ url('genres/drumnbass') }}">Drum&Bass</a></li>
                    <li><a href="{{ url('genres/dubstep') }}">Dubstep</a></li>
                    <li><a href="{{ url('genres/electro-house') }}">Electro House</a></li>
                    <li><a href="{{ url('genres/electronica-downtempo') }}">Electronica / Downtempo</a></li>
                    <li><a href="{{ url('genres/future-house') }}">Future House</a></li>
                    <li><a href="{{ url('genres/glitch-hop') }}">Glitch Hop</a></li>
                    <li><a href="{{ url('genres/hardcore-hardtechno') }}">Hardcore / Hard Techno</a></li>
                    <li><a href="{{ url('genres/hard-dance') }}">Hard Dance</a></li>
                    <li><a href="{{ url('genres/hiphop') }}">Hip-Hop</a></li>
                    <li><a href="{{ url('genres/house') }}">House</a></li>
                    <!--<li><a href="{{ url('genres/indiedance-nudisco') }}">Indie Dance / Nu Disco</a></li>-->
                    <li><a href="{{ url('genres/minimal') }}">Minimal</a></li>
                    <li><a href="{{ url('genres/progressive-house') }}">Progressive House</a></li>
                    <li><a href="{{ url('genres/psy-trance') }}">Psy-Trance </a></li>
                    <li><a href="{{ url('genres/reggae-dancehall-dub-dancehall') }}">Reggae / Dancehall / Dub </a></li>
                    <li><a href="{{ url('genres/tech-house') }}">Tech House</a></li>
                    <li><a href="{{ url('genres/techno') }}">Techno</a></li>
                    <li><a href="{{ url('genres/trance') }}">Trance</a></li>
                </ul>
            </li>
            <li>
              <a href="/soundcloudtracks">Soundcloud tracks <span class="label label-success">New</span></a>
            </li>
            <li class="hidden-sm">
              <a href="/donate">Donate Us</a>
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
                    @if (Auth::user()->type === 'admin')
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Administration <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/analytics') }}">Analytics</a></li>
								<li><a href="{{ url('/users') }}">Users</a></li>
								<li><a href="{{ url('/checksoundcloudtracks') }}">Soundcloud Tracks</a></li>
								<li><a href="{{ url('/checktracks') }}">Non-checked Tracks</a></li>
								<li><a href="{{ url('/wrongtracks') }}">Wrong Tracks</a></li>
								<li><a href="{{ url('/toptrack') }}" class="warning">Refresh Top100</a></li>
							</ul>
						</li>
                    @elseif (Auth::user()->type === 'checker')
                    	<li><a href="{{ url('/checktracks') }}">Non-checked Tracks</a></li>
                    @endif
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
                  <a href="/"><img class="img-responsive w-104 mt-10 center-block" src="{{ asset('img/kross.png') }}" alt="..."></a>
                   <h6 class="hidden-xs text-center mt-8 mb-10"><a href="#">2017 <i class="fa fa-copyright" aria-hidden="true"></i> CROSSLESS</a></h6>
                   <h6 class="visible-xs text-center">support@crossless.club</h6>
               </div>
               <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                   <h5 class="mt-20 text-center"><a href="/register">Register</a></h5>
                   <h5 class="text-center"><a href="/donate">Donate</a></h5>
                   <h5 class="text-center"><a href="/newtracks">Get tracks</a></h5>
               </div>
               <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                   <h4 class="mt-25 text-center">We are social</h4>
                   <h3 class="text-center mt-10">
                       <a href="https://www.instagram.com/crossless.club/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                       <a href="https://vk.com/crossless.club" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                   </h3>
               </div>
               <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                   <h4 class="mt-25 text-center">Collaboration & Info</h4>
                   <h6 class="text-center">crossless.club@gmail.com</h6>
               </div>
           </div>
          </div>
      </div>
    </div>
   <div class="bottom-player-block">
        <div class="col-xs-3 col-md-3">
            <img width=75 src="https://geo-media.beatport.com/image/15065864.jpg">
            <div class="bottom-player-title">
                <span class="title">Learning to Fall</span>
                <span class="author">Petar Dundov</span>
            </div>
        </div>
        <div class="col-xs-6 col-md-7">
            <div id="waveform"></div> 
            <div id="loading">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="col-xs-1 col-md-1 text-center bottom-player-block-buttons">
            <div class="bottom-player-block-control play"><i class="fa fa-play"></i></div>
        </div>
        <div class="col-xs-1 col-md-1 text-center bottom-player-block-buttons">
            <div class="bottom-player-block-control download_upload"><a href="#"><i class="fa fa-download"></i></a></div>
        </div>
    </div>
          
    <script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/wavesurfer.min.js') }}"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>

    var current_id = null;
        
    var wavesurfer = WaveSurfer.create({
        container: '#waveform',
        waveColor: '#1c1e22',
        cursorColor: '#c8c8c8',
        hideScrollbar: true,
        progressColor: '#c8c8c8',
        height: 60
    });
        
    function iconToggle(obj) {
        obj.toggleClass('fa-play');
        obj.toggleClass('fa-pause');
    }
        
    function iconPlay(obj) {
        obj.removeClass("fa-pause").addClass("fa-play");
    }
        
    function iconPause(obj) {
        obj.removeClass("fa-play").addClass("fa-pause");
    }
        
    wavesurfer.on('ready', function () {
        wavesurfer.play();
        $("#loading").hide();
    });
    
    wavesurfer.on('play', function () {
        iconPause($(".bottom-player-block-control.play").find("i"));
        iconPause($("a[data-id="+current_id+"]").find("i"));
    });
        
    wavesurfer.on('pause', function () {
        iconPlay($(".bottom-player-block-control.play").find("i"));
        iconPlay($("a[data-id="+current_id+"]").find("i"));
    });
        
    function aud_play_pause(object) {
        var myAudio = object.querySelector(".xnine-player");
        var myIcon = object.querySelector(".control");
        
 
        var id = $(object).data("id");
        var image = $(object).closest(".track").find(".track-image").attr("src");
        var title = $(object).closest(".track").find(".track-title").text();
        var author = $.trim($(object).closest(".track").find(".track-author").text());
        var src = $(object).closest(".track").find(".track-source-url").attr("src");
        var link = $(object).closest(".track").find(".track-link");
         
        if (wavesurfer.getCurrentTime() > 0 && current_id == id ) {
            wavesurfer.playPause();
        } 
                
        if (current_id != id) {
            $("#loading").show();
            wavesurfer.load(src);
            current_id = id;
            $("body").css("padding-bottom", "205px");
            $(".navbar-bottom").css("bottom", "75px");
            $(".bottom-player-block").css("bottom", "0px");
        } 
        
        $(".bottom-player-block").find("img").attr("src", image);
        $(".bottom-player-block").find(".bottom-player-title > .title").text(title);
        $(".bottom-player-block").find(".bottom-player-title > .author").text(author);
        $(".bottom-player-block-control.download_upload").empty().append(link.clone().removeClass('btn-success').removeClass('btn-info')).find('i').removeClass('fa-success');
                
    }
        
    $(".bottom-player-block-control > i").on("click", function() {
        wavesurfer.playPause();
    });
        
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59859427-2', 'auto');
  ga('send', 'pageview');

</script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
		$( ".selector" ).datepicker({
		  dateFormat: "yy-mm-dd"
		});
  });
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
