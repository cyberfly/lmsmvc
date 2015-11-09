@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ String::title($title) }}} ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')
@parent

@stop


{{-- Content --}}
@section('content')


<hr />

<a id="comments"></a>
<h4>{{ $questions->count() }} {{ \Illuminate\Support\Pluralizer::plural('Comment', $questions->count()) }}</h4>

@if ($questions->count())
@foreach ($questions as $question)
<div class="row">
	
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-11">
				{{ $question->body }}
			</div>
			
		</div>
	</div>
	<div class="col-md-3">
		<img class="thumbnail" src="http://placehold.it/60x60" alt="">
	</div>
</div>
<hr />
@endforeach
@else
<hr />
@endif

@stop
