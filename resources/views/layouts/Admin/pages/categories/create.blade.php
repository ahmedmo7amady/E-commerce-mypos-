@extends('layouts.Admin.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> @lang('site.categories') </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{route('admin.categories.index')}}"> @lang('site.categories')</a></li>
        <li class="active">@lang('site.create_new_category')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <div class="box box-primary">
      	<div class="box-header">
            <h3 class="box-title">@lang('site.create_new_category')</h3>
      	</div><!-- end of box header -->
      	<div class="box-body">
      		@include('layouts.Admin.includes._errors')
      		<form action="{{route('admin.categories.store')}}" method="post"> 
      			@csrf
      			@method('POST')

            @foreach(config('translatable.locales') as $locale)
              <div class="form-group">
                <!-- site.ar.name -->
                <label>@lang('site.'. $locale .'.name')</label>
                <input type="text" class="form-control" name="{{$locale}}[name]" value="{{ old($locale . '.name')}}">
              </div>
            @endforeach

      			<div class="form-group">
      				<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
      			</div>
      		</form>
      	</div><!-- end of box body-->

      </div><!-- end of the box -->

@endsection
