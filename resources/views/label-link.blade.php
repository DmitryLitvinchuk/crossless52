@if ($track -> label === 'Spinnin&#39; Remixes')
    <a href="label/spinnin">{{ $track -> label}}</a>
@elseif($track -> label === 'SPINNIN&#39; RECORDS')
    <a href="label/spinnin">{{ $track -> label}}</a>
@elseif($track -> label === 'SPRS')
    <a href="label/spinnin">{{ $track -> label}}</a>
@elseif($track -> label === "SPINNIN&#39; DEEP")
    <a href="label/spinnin">{{ $track -> label}}</a>
@elseif($track -> label === "Who&#39;s Afraid Of 138?!")
    <a href="label/who-is-afraid-of-138">{{ $track -> label}}</a>
@else
    <a href="labels/{{ $track -> label}}">{{ $track -> label}}</a>
@endif