<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Track;
use App\TopTrack;
use App\CustomTrack;
use App\SoundcloudTrack;
use SEOMeta;
use OpenGraph;
use Twitter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    //Главная страница
    public function index(SoundcloudTrack $soundcloudtrack, Track $track, TopTrack $toptrack)
    {
        $page_name = 'New Tracks';
		$soundcloudtracks = SoundcloudTrack::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(3);
        $tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(12);
		/*foreach($tracks as $track) {
			$date = $track -> updated_at;
			if ($date < '2017-11-27 02:23:30') {
				$track_id = $track -> top_track_id;
				$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
				$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
				$track -> cover = $img;
				$track->save();
			}
		}*/
		$needTracks = Track::where('track','!=',NULL)->orderBy('downloads', 'desc')->paginate(4);
        $toptracks = TopTrack::orderBy('top')->paginate(10);
        return view('main', compact('tracks', 'toptracks', 'soundcloudtracks', 'needTracks', 'page_name'));
    }
	
	//Главная страница
    public function AllCustomTracks(CustomTrack $customtrack)
    {
        //$page_name = 'Custom tracks';
        //$tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(12);
        $customtracks = CustomTrack::All();
		$image = Storage::disk('public')->url('c_44.jpg');
		return view('custom.alltracks', compact('customtracks', 'image'));
    }
    
    //Страница информации
    public function about()
    {
        SEOMeta::setTitle('About Us');
        return view('about');
    }
    
    //Страница жанра
    public function genre($genre)
    {
        //UPDATE tracks SET genre=TRIM(genre)
        if ($genre=='funk-soul-disco') {
                        $page_name='Funk / Soul / Disco';
        }
        elseif ($genre=='indiedance-nudisco') {
                        $page_name='Indie Dance / Nu Disco';
        }
        elseif ($genre=='deep-house') {
                        $page_name='Deep House';
        }
        elseif ($genre=='tech-house') {
                        $page_name='Tech House';
        }
        elseif ($genre=='big-room') {
                        $page_name='Big Room';
        }
        elseif ($genre=='house') {
                        $page_name='House';
        }
        elseif ($genre=='techno') {
                        $page_name='Techno';
        }
        elseif ($genre=='psy-trance') {
                        $page_name='Psy-Trance';
        }
        elseif ($genre=='future-house') {
                        $page_name='Future House';
        }
        elseif ($genre=='drumnbass') {
                        $page_name='Drum &amp; Bass';
        }
        elseif ($genre=='electro-house') {
                        $page_name='Electro House';
        }
        elseif ($genre=='dance') {
                        $page_name='Dance';
        }
        elseif ($genre=='hiphop') {
                        $page_name='Hip-Hop';
        }
        elseif ($genre=='trance') {
                        $page_name='Trance';
        }
        elseif ($genre=='minimal') {
                        $page_name='Minimal';
        }
        elseif ($genre=='electronica-downtempo') {
                        $page_name='Electronica / Downtempo';
        }
        elseif ($genre=='trap') {
                        $page_name='Trap';
        }
        elseif ($genre=='progressive-house') {
                        $page_name='Progressive House';
        }
        elseif ($genre=='dubstep') {
                        $page_name='Dubstep';
        }
        elseif ($genre=='hard-dance') {
                        $page_name='Hard Dance';
        }
        elseif ($genre=='funk-rnb') {
                        $page_name='Funk / R&amp;B';
        }
        elseif ($genre=='breaks') {
                        $page_name='Breaks';
        }
        elseif ($genre=='glitch-hop') {
                        $page_name='Glitch Hop';
        }
        elseif ($genre=='dubstep') {
                        $page_name='Dubstep';
        }
        elseif ($genre=='hardcore-hardtechno') {
                        $page_name='Hardcore / Hard Techno';
        }
        elseif ($genre=='funk-soul-disco') {
                        $page_name='Funk / Soul / Disco';
        }
        elseif ($genre=='reggae-dancehall-dub-dancehall') {
                        $page_name='Reggae / Dancehall / Dub';
        }
        elseif ($genre=='funky-groove-jackin-house') {
                        $page_name='Funky / Groove / Jackin&#39; House';
        }
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre_alias',$genre)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница лейбла
    public function label($label)
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = $label;
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('label',$label)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Spinnin
    public function Spinnin()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = "SPINNIN' RECORDS";
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('label','Spinnin&#39; Remixes')->orWhere('label','SPRS')->orWhere('label','SPINNIN&#39; RECORDS')->orWhere('label',"SPINNIN&#39; DEEP")->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Spinnin
    public function AfraidOf138()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = "Who's Afraid Of 138?!";
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('label',"Who&#39;s Afraid Of 138?!")->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Indie Dance / Nu Disco
    public function IndieDanceNuDisco()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Indie Dance / Nu Disco';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Indie Dance / Nu Disco')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Indie Dance / Nu Disco
    public function DrumBass()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Drum&Bass';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Drum &amp; Bass')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Electronica / Downtempo
    public function ElectronicaDowntempo()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Electronica / Downtempo';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Electronica / Downtempo')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Electronica / Downtempo
    public function HardcoreHardTechno()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Hardcore / Hard Techno';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Hardcore / Hard Techno')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Топ100
    public function top(Track $track)
    {
        //$toptracks = TopTrack::all();
        SEOMeta::setTitle('TOP100');
        SEOMeta::setKeywords(['lossless', 'download wav', 'beatport', 'download music', 'top 100']);
        $toptracks = DB::table('top_tracks')->get();
        foreach ($toptracks as $toptrack) {
			$date = $toptrack -> updated_at;
			if ($date < '2017-11-27 01:23:30') {
				$track_id = $toptrack -> id;
				$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
				$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
				$track = Track::where('top_track_id','=', $track_id)->first();
				$track -> cover = $img;
				$track->save();
				//echo $track -> cover;
				//$track->save();
			}
            //echo $toptrack->id;
            $number = $toptrack->id;
            $track = DB::table('tracks')->where('top_track_id', $number)->first();
            if ($track === null) {
                $html = new \Htmldom('https://www.beatport.com/track/chemistry-original-mix/'.$number);
                $title=$html->find('div.interior-title h1', 0)->plaintext;
                $remixer=$html->find('div.interior-title h1.remixed', 0)->plaintext;
                /*foreach($html->find('div.interior-track-artists a') as $artist) {
                    $artist = $artist->innertext.' ';
                }*/
                $artist = $html->find('div.interior-track-artists a', 0)->innertext;
                $release=$html->find('li.interior-track-released span.value', 0)->plaintext;
                $bpm=$html->find('li.interior-track-bpm span.value', 0)->plaintext;
                $key=$html->find('li.interior-track-key span.value', 0)->plaintext;
                $genre=$html->find('li.interior-track-genre span.value', 0)->plaintext;
                $new_genre = trim($genre);
                $label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
                $new_label = trim($label);
                $img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');;
                //$number=$html->find('button.playable-play',0)->getAttribute('data-track');
                $audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
                $track = Track::create(['title' => $title, 
                                        'user_id' => NULL, 
                                        'top_track_id' => $number, 
                                        'artist' => $artist, 
                                        'genre' => $new_genre, 
                                        'bpm' => $bpm, 
                                        'key' => $key, 
                                        'cover' => $img,
                                        'remixer' => $remixer,
                                        'label' => $new_label,
                                        'release' => $release, 
                                        'preview' => $audio_link]);
                //echo $track->label;
            }
            /*if ($track !== null) {
                echo $track->label;
            }*/
            
        }
        $toptracks = TopTrack::orderBy('top')->paginate(100);
        return view('top', compact('toptracks'));
    }
    
    //Страница стстистики
    public function analytics(User $User)
    {
        if (Auth::user()->type === 'admin') {
            $page_name = 'Analytics';
            $number_of_tracks = Track::where('track','!=',NULL)->count();
            $number_of_users = User::count();
            $checked_tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->count();
            return view('analytics', compact('page_name', 'number_of_tracks', 'checked_tracks', 'number_of_users'));
        }
        else {
            return redirect('/');
        }
    }
	
	//Ввод ссылки на Drom.ru
    public function arparts(Request $request)
    {
		if (Auth::check()) {
			if (Auth::user()->type === 'admin') {
        		return view('arparts.chooseType');
			}
			else {
				return redirect('/');
			}
		}
		else {
			return redirect('/login');
		}
    }
	
	//Ввод ссылки на Drom.ru
    public function arpartsDrom(Request $request)
    {
		if (Auth::check()) {
			if (Auth::user()->type === 'admin') {
				$page_name = 'DROM.RU';
				$link = 'baza.drom.ru';
        		return view('arparts.inputarparser', compact('page_name', 'link'));
			}
			else {
				return redirect('/');
			}
		}
		else {
			return redirect('/login');
		}
    }

	//Создать трек через Add Track
    public function arpartsParser1(Request $request)
    {
        if (Auth::user()->type === 'admin') {
            $beat = $request['html'];
            $v = Validator::make($request->all(), [
                "html" => "required|url"
            ]);
            //if ($v->fails()) {
            //    $error = 'INVALID URL';
			//	return view('errors.validate', compact('error'));
            //}
            //else {
                $html = new \Htmldom('https://www.autodoc.ru/part/vdo--83/'.$beat.'/');

                $title=$html->find('.ContentHeader', 0)->innertext;
				echo $title.' для ';
				/*foreach ($html->find('.fil-brands li') as $model) {
					echo $model->plaintext.'<br>';
				}*/
				//echo $model=$html->find('.fil-brands li', 0)->plaintext.'<br>';
				//echo $brand='fil'.$model;
				/*foreach ($html->find('.fil-brands li') as $brand) {
					echo $brand->plaintext.'<br>';
					
				}
				foreach ($html->find('.fil-models li') as $model) {
						echo $model->plaintext.'<br>';
				}*/
				
				foreach ($html->find('.fil-models') as $model) {
					
					echo substr($model->id, 3).' ';
					echo '(';
					foreach ($model->find('li') as $mark) {
						echo $mark->plaintext.', ';
					}
					echo ')';
					echo ', ';
				}
				echo 'в интернет-магазине ARparts';
				echo '<hr>';
				echo $title.', ';
				foreach ($html->find('.fil-models') as $model) {
					
					echo substr($model->id, 3).', ';
					foreach ($model->find('li') as $mark) {
						echo $mark->plaintext.', ';
					}
				}
				echo 'Санкт-Петербург, Спб, Питер, Отправка в регионы, Доставка по России <br><br>';
				echo '<hr>';
			
				echo 'Не уверены, подойдет ли данная деталь на Ваш автомобиль?! <br><br>';
				echo 'ЗВОНИТЕ +7(812) 407-37-33 или оставьте VIN-ЗАПРОС наши специалисты подберут именно те запчасти, которые необходимы Вашему автомобилю! <br><br>';
				echo 'Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности у наших менеджеров по телефону. <br><br>';
				echo 'Так же купить запчасти на любые иномарки Вы можете в наших магазинах. Адреса магазинов Вы можете увидеть в разделе контакты. <br><br>';
				echo 'Быстрая доставка по Санкт-Петербургу и отправка в любой регион России и СНГ. <br>';

				/*foreach ($html->find('.fil-models li') as $model) {
					echo $model->plaintext.'<br>';
				}*/
                //$remixer=$html->find('div.interior-title h1.remixed', 0)->plaintext;
                /*foreach($html->find('div.interior-track-artists a') as $artist) {
                    $artist = $artist->innertext.' ';
                }*/
                /*$artist = $html->find('div.interior-track-artists a', 0)->innertext;
                $release=$html->find('li.interior-track-released span.value', 0)->plaintext;
                $bpm=$html->find('li.interior-track-bpm span.value', 0)->plaintext;
                $key=$html->find('li.interior-track-key span.value', 0)->plaintext;
                $genre=$html->find('li.interior-track-genre span.value', 0)->plaintext;
                $label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
                $new_label = trim($label);
                $img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
                $number=$html->find('button.playable-play',0)->getAttribute('data-track');
                $audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                $row = Track::where('top_track_id','=',$number)->count();*/
                //echo $title, $models;
            //}
        }
        else {
            return redirect('/login');
        }
    }
	
	//Парсер с Drom.ru
    public function arpartsDromParser(Request $request)
    {
        if (Auth::user()->type === 'admin') {
            $beat = $request['html'];
            $v = Validator::make($request->all(), [
                "html" => "required|url"
            ]);
                $html = new \Htmldom($beat);

                $title_promo=$html->find('h1.subject span', 0)->plaintext;
				//$image=$html->find('pswp__img', 3)->getAttribute('src');
				//echo $image;
				$types = array();
				foreach ($html->find('div[id=breadcrumbs] span') as $type) {
					
					/*$mark = explode(',', $mark); 
					$mark = str_replace("<li>","",$mark);
					$mark = str_replace("</li>","",$mark);
					$mark = $mark[0];*/
					$type=$type->plaintext;
					array_push($types, $type);
				}
				$title = array_pop($types);
				$category = $types[count($types)-1];
				//echo $title.'<br>';
			    $price=$html->find('.viewbull-summary-price__value', 0)->plaintext;
				$price = substr($price,0,-4);
				$price = str_replace(" ","",$price);
				$price = (int) $price;
				$price_main = $price;
				if ($price<=5000) {
					$price = $price*1.45;
					$price = ceil($price/100) * 100;
				}
				else {
					$price = $price*1.3;
					$price = ceil($price/100) * 100;
				}
				//echo 'Цена: ';
				//echo $price.'<br>';
				//echo '<hr>';
				//$img=$html->find('.bulletinImages .image img', 0)->getAttribute('src');
				$number=$html->find('span.inplace', 5)->plaintext;
				$number = explode(',', $number);  
				$number = $number[0];
				//echo 'Номер в каталоге: '.$number;
				//echo '<hr>';
				$models = array();
				foreach ($html->find('.autoPartsModel .inplace li') as $mark) {
					/*foreach ($model->find('li') as $mark) {
						echo $mark->plaintext.', ';
					}*/
					
					$mark = explode(',', $mark);
					$mark = str_replace("<li>","",$mark);
					$mark = str_replace("</li>","",$mark);
					$mark = $mark[0];
					if ($mark == 'Toyota Corolla') {
						$mark = 'Toyota Corolla'.' (Тойота Королла)';
					}
					array_push($models, $mark);
					//echo $mark;
				}
				$models = array_unique($models);
				//print_r($models);
				/*foreach ($html->find('.autoPartsEngine span.inplace') as $engine) {
					$mark = explode(',', $mark); 
					$mark = str_replace("<li>","",$mark);
					$mark = str_replace("</li>","",$mark);
					$mark = $mark[0];
					array_push($models, $mark);
				}*/
				$engine=''; //пустое значение в массив
				$parsed_engine=$html->find('.autoPartsEngine span.inplace', 0)->plaintext; //парсим номера двигателей
				$engines = explode(',', $parsed_engine); //разделяем их по зяпятой
				$withoutEndEngines = array(); //пустой массив для конечных вариантов
				foreach ($engines as $engine) {
					$engine = trim($engine); //убираем пробелы
					$amountOfLetters = iconv_strlen ($engine); //считаем количество знаков в номере
					if ($amountOfLetters >= 5) {
						$engine = substr($engine,0,-2); //убираем последние 2
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1); //1 знак
						}
						array_push($withoutEndEngines, $engine); //добваляем в финальный массив
					}
					else {
						$lastLetter = substr($engine, -1); //смотрим что осталось в конце
						if ($lastLetter == 'F' || $lastLetter == 'T') { //если это все-ещё модификация - дропаем её
							$engine = substr($engine,0,-1);//1 знак
						}
						array_push($withoutEndEngines, $engine);//добваляем в финальный массив
					}
					/*$firstLetter = substr($engine, 1, 2);
					echo $firstLetter.',';
					if ($firstLetter == '2AZ') {
						$engine = 'Это работает';
						array_push($withoutEndEngines, $engine);
						echo $firstLetter;
					}*/
				}
				$withoutEndEngines = array_unique($withoutEndEngines); //только цникальные значения в массиве
				//print_r($withoutEndEngines);
				$firstMark = current($models); //первый элемент марки и модели
				$firstMark = $firstMark.' '; //пробел в конце марки и модели
				$firstEngines = array_slice($withoutEndEngines,0,2); //получаем первые 2 двигателя
				$firstEngines = implode(", ", $firstEngines); //соединяем двигатели через запятую
				$titleOfAd = $title.$firstMark.'('.$firstEngines.')'; //создаем название
					//Подсчёт знаков
				/*$amountOfSymbols = iconv_strlen($titleOfAd);
				if ($amountOfSymbols>50) {
					$titleOfAdShort = $title.'('.$firstEngines.')';
				}
				$amountOfSymbols = iconv_strlen($titleOfAd);
				if ($amountOfSymbols>50) {
					$firstEngines = array_slice($withoutEndEngines,0,1);
					$titleOfAdExtraShort = $title.'('.$firstEngines.')';
				}*/
			
			
				//echo $titleOfAd;
				//print_r ($models);
				//echo 'в интернет-магазине ARparts';
				//echo '<hr>';
				/*echo $title.', ';
				foreach ($html->find('.fil-models') as $model) {
					
					echo substr($model->id, 3).', ';
					foreach ($model->find('li') as $mark) {
						echo $mark->plaintext.', ';
					}
				}*/
				/*echo 'Если Вы не уверены подойдет ли данная деталь на Ваш автомобиль,ЗВОНИТЕ, наши специалисты помогут подобрать именно то, что Вам необходимо! <br><br>';
				echo 'Качественная установка купленных запчастей в нашем АВТОСЕРВИСЕ с 15% скидкой! Подробности уточняйте у наших менеджеров по телефонам! <br><br>';
				echo 'Уточнить совместимость детали и наличие на складе Вы можете нажав кнопку ЗАДАТЬ ВОПРОС!';
				echo '<hr>';*/
				return view('arparts.drom', compact('title', 'price', 'number', 'models', 'engine', 'category', 'title_promo', 'price_main', 'parsed_engine', 'titleOfAd'));
        }
        else {
            return redirect('/');
        }
    }
	
	
	
	//Донаты
    public function donate( )
    {
        if (Auth::check()) {
            return view('billing');
        }
        else {
            return redirect('/login');
        }
    }
}