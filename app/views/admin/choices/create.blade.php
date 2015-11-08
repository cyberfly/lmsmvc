@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('admin/choices/') }}}" class="btn btn-default btn-small btn-inverse"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
			</div>
		</h3>
	</div>


	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">Meta data</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit choice Form --}}
	<form class="form-horizontal" method="post" action="{{ URL::to('admin/choices/create') }}" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				
				<!-- Question  -->
				<div class="form-group {{{ $errors->has('question_id') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="question_id">Question</label>
						{{ Form::select('question_id', $questions, null, array('class' => 'form-control')) }}
						{{ $errors->first('question_id', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ Question  -->

				<!-- Post Title -->
				<div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="title">Choice Title</label>
						<input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title') }}}" />
						{{ $errors->first('title', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ post title -->

				<!-- Content -->
				<div class="form-group {{{ $errors->has('body') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="body">Choice Body</label>
						<textarea class="form-control full-width wysihtml5" name="body" value="body" rows="10">{{{ Input::old('body') }}}</textarea>
						{{ $errors->first('body', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ content -->

				<!-- Correct Choice? -->
				<div class="form-group {{{ $errors->has('correct_choice') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="correct_choice">Correct Choice?</label>
						
						<div class="radio">
						  <label>
						    {{ Form::radio('correct_choice', 'N', true); }}
						    No
						  </label>
						</div>
						<div class="radio">
						  <label>
						    {{ Form::radio('correct_choice', 'Y', false); }}
						    Yes
						  </label>
						</div>
						
						{{ $errors->first('correct_choice', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ Correct Choice? -->

				<!-- correct mark -->
				<div class="form-group {{{ $errors->has('correct_mark') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="correct_mark">Choice Mark</label>
						{{ Form::text('correct_mark','0', array('class' => 'form-control')); }}						
						{{ $errors->first('correct_mark', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ correct mark -->

			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- Meta Title -->
				<div class="form-group {{{ $errors->has('meta-title') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-title">Meta Title</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="" />
						{{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta title -->

				<!-- Meta Description -->
				<div class="form-group {{{ $errors->has('meta-description') ? 'has-error' : '' }}}">
					<div class="col-md-12 controls">
                        <label class="control-label" for="meta-description">Meta Description</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="" />
						{{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta description -->

				<!-- Meta Keywords -->
				<div class="form-group {{{ $errors->has('meta-keywords') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="" />
						{{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta keywords -->
			</div>
			<!-- ./ meta data tab -->
		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Create</button>
				<button type="reset" class="btn btn-default">Reset</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
