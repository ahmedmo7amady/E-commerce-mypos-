@extends('layouts.Admin.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> @lang('site.clients') </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{route('admin.clients.index')}}"> @lang('site.clients')</a></li>
        <li class="active">@lang('site.create_new_client')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <div class="box box-primary">
      	<div class="box-header">
            <h3 class="box-title">@lang('site.create_new_client')</h3>
      	</div><!-- end of box header -->
      	<div class="box-body">
      		@include('layouts.Admin.includes._errors')
      		<form action="{{route('admin.clients.store')}}" method="post"> 
      			@csrf
      			@method('POST')


      			<div class="form-group">
              <label> @lang('site.name')</label>
      				<input type="text" name="name" value="{{old('name')}}" class="form-control" ></input>
      			</div>
            @for($i=0 ; $i<2 ; $i++)
              <div class="form-group">
                <label> @lang('site.phone')</label>
                <input type="text" name="phone[]" class="form-control" ></input>
              </div>
            @endfor
      			<div class="form-group">
              <label> @lang('site.address')</label>
      				<textarea type="text" name="address" value="{{old('address')}}" class="form-control" ></textarea>
      			</div>
      			<div class="form-group">
      				<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
      			</div>
      		</form>
      	</div><!-- end of box body-->

      </div><!-- end of the box -->

@endsection
