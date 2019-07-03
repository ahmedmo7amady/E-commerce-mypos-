@extends('layouts.Admin.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> @lang('site.users') </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{route('admin.users.index')}}"> @lang('site.users')</a></li>
        <li class="active">@lang('site.create_new_user')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <div class="box box-primary">
      	<div class="box-header">
            <h3 class="box-title">@lang('site.create_new_user')</h3>
      	</div><!-- end of box header -->
      	<div class="box-body">
      		@include('layouts.Admin.includes._errors')
      		<form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data"> 
      			@csrf
      			@method('POST')
      			<div class="form-group">
      				<label>@lang('site.first_name')</label>
      				<input type="text" class="form-control" name="first_name" value="{{old('first_name')}}">
      			</div>
      			<div class="form-group">
      				<label>@lang('site.last_name')</label>
      				<input type="text" class="form-control" name="last_name" value="{{old('last_name')}}">
      			</div>
      			<div class="form-group">
      				<label>@lang('site.email')</label>
      				<input type="email" class="form-control" name="email" value="{{old('email')}}">
      			</div>
      			<div class="form-group">
      				<label>@lang('site.image')</label>
      				<input type="file" class="form-control image" name="image" >
      			</div>
      			<div class="form-group">
					<img src="{{asset('uploads/user_images/default.png')}}" style="width:100px" class="img-thumbnail image-preview" >
      			</div>
      			<div class="form-group">
      				<label>@lang('site.password')</label>
      				<input type="password" class="form-control" name="password" >
      			</div>
      			<div class="form-group">
      				<label>@lang('site.password_confirmation')</label>
      				<input type="password" class="form-control" name="password_confirmation" >
      			</div>
      			<div class="form-group">
      				<label>@lang('site.permissions')</label>
			  		<div class="nav-tabs-custom">

                        @php

                            $maps=['create' , 'read' , 'update' , 'delete'];
                            $models = ['users' , 'users' , 'product'];

                        @endphp

			            <ul class="nav nav-tabs pull-right">
                            @foreach($models as $index=>$model)
                                <li class="{{$index == 0 ? 'active' : ''}}"><a href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>
                            @endforeach
			            </ul>

                        <div class="tab-content">
                            @foreach($models as $index=>$model)
                            <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">
                                @foreach($maps as $map)
                                    <label><input type="checkbox" name="permissions[]" value="{{$map . '_' . $model}}"> @lang('site.'.$map)</label>
                                @endforeach
                            </div><!-- end of nav-tab -->
			                @endforeach
			            </div><!-- end of nav-content -->
			          </div><!-- end of nav-tabs -->
			          <!-- nav-tabs-custom -->
			      </div><!-- end of form group -->

      			<div class="form-group">
      				<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
      			</div>
      		</form>
      	</div><!-- end of box body-->

      </div><!-- end of the box -->

@endsection
