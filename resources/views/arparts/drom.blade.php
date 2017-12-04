<!doctype html>
<html lang="ru">
  <head>
    <title>{{ $title }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
		<h1>Для DROM.ru</h1>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
			  	<h4>Категория: {{ $category }}</h4>
                <h2 class="display-4">{{ $title }}</h2>
			  	<br>
				<h3>Цена: {{ $price }} рублей</h3>
			  	<br>
				<h3>Номер в каталоге: {{ $number }}</h3>
			  	<br>
			    <h3>Применимость:</h3>
			  	<ul>
					@foreach ($models as $model)
						<li>{{ $model }}</li>
					@endforeach
				</ul>
			    <br>
			    <p>
					  Если Вы не уверены подойдет ли данная деталь на Ваш автомобиль, ЗВОНИТЕ, наши специалисты помогут подобрать именно то, что Вам необходимо! <br><br>

					  Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности уточняйте у наших менеджеров по телефонам!<br><br>

					  Уточнить совместимость детали и наличие на складе Вы можете нажав кнопку ЗАДАТЬ ВОПРОС!
			    </p>
          </div>
        </div>
		<hr>
		<h1>Для AVITO.ru</h1>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
			  	<h4>Категория: {{ $category }}</h4>
                <h2 class="display-4">{{ $title }}</h2>
			  	<br>
				<h3>Цена: {{ $price }} рублей</h3>
			  	<br>
			    <p>
					  <strong>JDMstore - это более 2 500 000 запчастей в наличии и под заказ для японских автомобилей: Toyota, Nissan, Mitsubishi, Honda! Звоните, наши опытные менеджеры подберут необходимую Вам деталь в кратчайшие сроки!</strong><br><br>

						<strong>В продаже:</strong><br>

						<i> 
							{{ $title }},
							@foreach ($models as $model)
								{{$model }},
							@endforeach 
							
							в Санкт-Петербурге.</i><br>



						 <strong>Применимость:</strong><br>
							<ul>
						    @foreach ($models as $model)
								<li>{{ $model }}</li>
							@endforeach
							</ul>


						<strong>Для двигателей:</strong>

						{{ $engine }}<br>



						<strong><i>Так же есть детали других производителей новые и контрактные!</i><br>

						Качественная установка купленных автозапчастей в нашем автосервисе с 20% скидкой!<br>

						Информацию об ОПЛАТЕ И ДОСТАВКЕ Вы можете посмотреть на нашем сайте или в соответствующих разделах на авито!</strong>
			    </p>
          </div>
        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
