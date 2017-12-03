@extends('layouts.app')

@section('meta')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <div class="container mt-20">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
                <h2>{{ $title }}</h2>
				<h3>Цена: {{ $price }} рублей</h3>
				<h3>Номер в каталоге: {{ $number }}</h3>
			    <h3>Применимость:</h3>
				@foreach ($models as $model)
					<h4>{{ $model }}</h4>
				@endforeach
			    <br>
			    <p>
					  Если Вы не уверены подойдет ли данная деталь на Ваш автомобиль, ЗВОНИТЕ, наши специалисты помогут подобрать именно то, что Вам необходимо! <br><br>

					  Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности уточняйте у наших менеджеров по телефонам!<br><br>

					  Уточнить совместимость детали и наличие на складе Вы можете нажав кнопку ЗАДАТЬ ВОПРОС!
			    </p>
          </div>
        </div>
    </div>

@endsection
    
