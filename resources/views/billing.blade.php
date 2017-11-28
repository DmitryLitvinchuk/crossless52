@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container mt-20">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
              <h3>
              	Crossless – The Easiest way to exchange your own lossless tracks. 
              </h3>
            <blockquote>
                <p>If you donate us, you will get a special offer</p>
                <small>
                	40 points and a pack of TopTracks
				</small>
            </blockquote>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
             <iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=buyer&targets=&targets-hint=Input%20your%20Account-Name%20or%20Email&default-sum=100&button-text=11&payment-type-choice=on&mail=on&hint=&successURL=&quickpay=shop&account=410011701320333" width="450" height="225" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
          </div>
        </div>
    </div>

@endsection
    
