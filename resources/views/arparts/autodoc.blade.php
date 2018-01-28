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
         	 {{ $title }} для BMW (1, 2, 3, 4, 5, 6, 7, X1, X3, X5, X6, Z4, ), в интернет-магазине ARparts
			FEBI 34382 - Датчик положения распредвала, BMW, 1, 2, 3, 4, 5, 6, 7, X1, X3, X5, X6, Z4, Санкт-Петербург, Спб, Питер, Отправка в регионы, Доставка по России 

			Не уверены, подойдет ли данная деталь на Ваш автомобиль?! 

			ЗВОНИТЕ +7(812) 407-37-33 или оставьте VIN-ЗАПРОС наши специалисты подберут именно те запчасти, которые необходимы Вашему автомобилю! 

			Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности у наших менеджеров по телефону. 

			Так же купить запчасти на любые иномарки Вы можете в наших магазинах. Адреса магазинов Вы можете увидеть в разделе контакты. 

			Быстрая доставка по Санкт-Петербургу и отправка в любой регион России и СНГ. 
			  	<h4>Категория: {{ $category }}</h4>
                <h2 class="display-4">{{ $titleOfAd }}</h2>
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
                <h2 class="display-4">{{ $titleOfAd }}</h2>
			  	<br>
				<h3>Цена: {{ $price }} рублей</h3>
			  	<br>
			    <p>
					  <strong>JDMstore - это более 2 500 000 запчастей в наличии и под заказ для японских автомобилей: Toyota, Nissan, Mitsubishi, Honda! Звоните, наши опытные менеджеры подберут необходимую Вам деталь в кратчайшие сроки!</strong><br><br>

						<strong>В продаже:</strong><br>

						<i> 
							{{ $titleOfAd }}
							
							в Санкт-Петербурге.</i> Новый!<br>



						 <strong>Применимость:</strong><br>
							<ul>
						    @foreach ($models as $model)
								<li>{{ $model }}</li>
							@endforeach
							</ul>


						<strong>Для двигателей:</strong>

						{{ $parsed_engine }}<br>



						<strong><i>Так же есть детали других производителей новые и контрактные!</i><br>

						Качественная установка купленных автозапчастей в нашем автосервисе с 20% скидкой!<br>

						Информацию об ОПЛАТЕ И ДОСТАВКЕ Вы можете посмотреть на нашем сайте или в соответствующих разделах на авито!</strong>
			    </p>
          </div>
        </div>
		
	  	<h1>На ARparts.ru</h1>
	  
	  <div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  <p><b>Заголовок:</b> <br>{{ $titleOfAd }}, {{ $number }}
			  </p>
			  <p><b>Ключевые слова:</b> <br>{{ $title }},
				  купить в Санкт-Петербурге, Спб, отправка по России, самая низкая цена, дешево, срочно, цена, Мурманск, Ханты-Мансийск, Краснодар, Калининград, Воронеж, Волгоград, Ростов, Казань
			  </p>
			  <p>Купить {{ $title }},
					@foreach ($models as $model)
						{{ $model }},
					@endforeach
				  по самой низкой цене в Санкт-Петербурге, Мурманске, Ханты-Мансийске, Краснодаре, Калининграде, Воронеже, Волгограде, Ростове или отправить в другой регион, {{ $number }}
			  </p>
		  </div>
	  </div>
	   <!-- row starts -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <div class="container">-->
	    <div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			  <img src="http.jpg" class="img-fluid align-middle" alt="{{ $title }}, {{ $number }}" style="width:100%; margin-bottom: 18px; border-radius: 0.3rem;">
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			  <div class="jumbotron" style="padding-bottom:15px; padding-top:15px;">
				  <h1 class="display-4" style="font-size: 2.5rem;">{{ $titleOfAd }}</h1>
				  <p class="lead">{{ $category }}</p>
				  <p class="lead">Цена: {{ $price_main }} рублей</p>
				  <hr class="my-4">
				  <div class="row">
					  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  		<p>Номер в каталоге: {{ $number }}</p>
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						  <p>
							  <strong>Применимость:</strong><br>
								<ul>
								@foreach ($models as $model)
									<li>{{ $model }}</li>
								@endforeach
								</ul>
						  </p>
					  </div> 
					  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						  <p>
							  <strong>Двигатели:</strong><br>
								<p>
									{{ $parsed_engine }}
								</p>
						  </p>
					  </div> 
				  </div>

				  <p class="lead">
					<a class="btn btn-success btn-lg" href="tel:89006532264" role="button">WhatsApp: 8 900 653-22-64</a>
				  </p>
				  <p class="lead">
					<a class="btn btn-primary btn-lg" href="tel:88129217414" role="button">Телефон: 8 812 921-74-14</a>
				  </p>
				  <div class="alert alert-success" role="alert">
				  	Не забудьте заказть установку детали в нашем автосервисе со скидкой 15%
				  </div>
				</div>
		  </div>
        </div>
<!--</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

-->
	
	
	<!--<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="jumbotron" style="padding: 20px;">
				  <h1 class="display-4" style="font-size: 2.5rem;">УСТАНОВИТЕ КУПЛЕННЫЕ СТЕКЛА В НАШЕМ АВТОСЕРВИСЕ</h1>
					  <img src="http://avtostekla7.ru/bitrix/images/avtostekla-zamena.jpg" class="img-fluid align-middle" alt="Установка автостекол" style="width:100%; margin-bottom: 18px; border-radius: 0.3rem;">
					<p style="font-size:22px;">
						Теперь для того что бы поменять стекло на своем автомобиле не нужно покупать его в одном месте, а затем ехать на установку в другое. Все это Вы можете сделать в одном месте по адресу <strong>пр. Народного Ополчения 28А</strong>. 
						<br>
						<p style="margin-bottom:0px;font-size:22px;">Наш магазин занимается продажей и установкой автостекла на любой автомобиль:</p>
						<ul style="font-size:20px;">
							<li>Toyota</li>
							<li>Nissan</li>
							<li>Mitsubishi</li>
							<li>Honda</li>
							<li>Subaru</li>
							<li>BMW</li>
							<li>Mercedes</li>
							<li>Volvo</li>
							<li>Opel</li>
							<li>Ford и другие!</li>
						</ul>
					</p>
					<hr>
					<p class="lead">Адрес: пр. Народного Ополчения 28А</p>
					<p class="lead text-center">
						<a class="btn btn-primary btn-lg" href="tel:88129217414" role="button">Телефон: 8 812 921-74-14</a>
					</p>
				</div>
			</div>
		</div>-->
		<!-- row ends -->
		<!-- second row starts -->
		<!--<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  <img src="http://i943.photobucket.com/albums/ad277/th3crvcr3w/IMG_20131019_142815_0_1_zpsc0a694da.jpg" class="img-fluid " alt="Responsive image">
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  <div class="jumbotron">
				  <h1 class="display-4">{{ $title }}</h1>
				  <p class="lead">{{ $category }}</p>
				  <p class="lead">Цена: {{ $price_main }} рублей</p>
				  <hr class="my-4">
				  <div class="row">
					  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  		<p>Номер в каталоге: {{ $number }}</p>
					  </div>
				  </div>
				  <div class="row">
					  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						  <p>
							  <strong>Применимость:</strong><br>
								<ul>
								@foreach ($models as $model)
									<li>{{ $model }}</li>
								@endforeach
								</ul>
						  </p>
					  </div> 
					  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						  <p>
							  <strong>Двигатели:</strong><br>
								<p>
									{{ $engine }}
								</p>
						  </p>
					  </div> 
				  </div>

				  <p class="lead">
					<a class="btn btn-success btn-lg" href="tel:89006532264" role="button">WhatsApp: 8 (900) 653-22-64</a>
				  </p>
				  <p class="lead">
					<a class="btn btn-primary btn-lg" href="tel:88129882264" role="button">Телефон: 8 812 988-22-64</a>
				  </p>
				  <div class="row">
					  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  		<p>Не забудьте заказать установку в нашем автосервисе со скидкой 15%</p>
					  </div>
				   </div>
				</div>
		  </div>
        </div>-->
		<!-- second row ends -->

		<!-- <div class="row">
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
							{{ $title }}
							
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
		</div> -->
    </div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
