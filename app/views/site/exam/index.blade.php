@extends('site.layouts.default')

{{-- Content --}}
@section('content')

<div class="jumbotron">
	{{ Form::open(array('url' => 'exams/create')) }}
	<h1>Mock Up Exam</h1>
	<p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
	<p><button class="btn btn-lg btn-success" type="submit">Start Mock Up Exam Now</button></p>
	{{ Form::close() }}
</div>

<div class="row marketing">
	<div class="col-lg-6">
	  <h4>Subheading</h4>
	  <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

	  <h4>Subheading</h4>
	  <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

	  <h4>Subheading</h4>
	  <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
	</div>

	<div class="col-lg-6">
	  <h4>Subheading</h4>
	  <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

	  <h4>Subheading</h4>
	  <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

	  <h4>Subheading</h4>
	  <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
	</div>
</div>

@stop
