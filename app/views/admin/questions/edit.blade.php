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
				<a href="{{{ URL::to('admin/questions/') }}}" class="btn btn-default btn-small btn-inverse"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
			</div>
		</h3>
	</div>


	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">Meta data</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Question Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($question)){{ URL::to('admin/questions/' . $question->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- Post Title -->
				<div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="title">Question Title</label>
						<input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($question) ? $question->title : null) }}}" />
						{{ $errors->first('title', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ post title -->

				<!-- Content -->
				<div class="form-group {{{ $errors->has('body') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="body">Question Body</label>
						<textarea class="form-control full-width wysihtml5" name="body" value="body" rows="10">{{{ Input::old('body', isset($question) ? $question->body : null) }}}</textarea>
						{{ $errors->first('body', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ content -->
			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- Meta Title -->
				<div class="form-group {{{ $errors->has('meta-title') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-title">Meta Title</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($question) ? $question->meta_title : null) }}}" />
						{{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta title -->

				<!-- Meta Description -->
				<div class="form-group {{{ $errors->has('meta-description') ? 'has-error' : '' }}}">
					<div class="col-md-12 controls">
                        <label class="control-label" for="meta-description">Meta Description</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($question) ? $question->meta_description : null) }}}" />
						{{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta description -->

				<!-- Meta Keywords -->
				<div class="form-group {{{ $errors->has('meta-keywords') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($question) ? $question->meta_keywords : null) }}}" />
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
				<button type="submit" class="btn btn-success">Update</button>
				<button type="reset" class="btn btn-default">Reset</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
