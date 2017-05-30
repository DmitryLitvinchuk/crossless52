@if ($track -> genre === 'Indie Dance / Nu Disco')
    <a href="genre/indie-dance-nu-disco">{{ $track -> genre}}</a>
@elseif($track -> genre === 'Drum &amp; Bass')
    <a href="genre/drum-bass">{{ $track -> genre}}</a>
@elseif($track -> genre === 'Electronica / Downtempo')
    <a href="genre/electronica-downtempo">{{ $track -> genre}}</a>
@elseif($track -> genre === 'Hardcore / Hard Techno')
    <a href="genre/hardcore-hard-techno">{{ $track -> genre}}</a>
@elseif($track -> genre === 'Hardcore / Hard Techno')
    <a href="genre/hardcore-hard-techno">{{ $track -> genre}}</a>
@else
    <a href="genres/{{ $track -> genre_alias}}">{{ $track -> genre}}</a>
@endif