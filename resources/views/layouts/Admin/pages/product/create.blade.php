@extends('layouts.Admin.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> @lang('site.products') </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{route('admin.products.index')}}"> @lang('site.products')</a></li>
        <li class="active">@lang('site.create_new_product')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <div class="box box-primary">
      	<div class="box-header">
            <h3 class="box-title">@lang('site.create_new_product')</h3>
      	</div><!-- end of box header -->
      	<div class="box-body">
      		@include('layouts.Admin.includes._errors')
      		<form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data"> 
      			@csrf
      			@method('POST')


            <div class="form-group">
              <lable>@lang('site.categories')</lable>
              <select  name="category_id" class="form-control">
              <option value="">@lang('site.all_categories')</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}" {{old('category_id') == $category->id  ? 'selected' : ''}} > {{$category->name}} </option>
              @endforeach
              </select>
            </div>


            @foreach(config('translatable.locales') as $locale)
              <div class="form-group">
                <!-- site.ar.name -->
                <label>@lang('site.'. $locale .'.name')</label>
                <input type="text" class="form-control" name="{{$locale}}[name]" value="{{ old($locale . '.name')}}">
              </div>
              <div class="form-group">
                <!-- site.ar.name -->
                <label>@lang('site.'. $locale .'.description')</label>
                <textarea type="text" class="form-control ckeditor" name="{{$locale}}[description]">{{ old($locale . '.description')}}</textarea>
              </div>
            @endforeach
            <div class="form-group">
      				<label>@lang('site.image')</label>
      				<input type="file" class="form-control image" name="image" >
      			</div>
      			<div class="form-group">
					    <img src="{{asset('uploads/product_images/default.png')}}" style="width:100px" class="img-thumbnail image-preview" >
            </div>
            
            <div class="form-group">
      				<label>@lang('site.purchase_price')</label>
      				<input type="number" class="form-control" name="purchase_price" value="{{old('purchase_price')}}" >
            </div>
            
            <div class="form-group">
      				<label>@lang('site.sale_price')</label>
      				<input type="number" class="form-control" name="sale_price"  value="{{old('sale_price')}}" >
            </div>
            
            <div class="form-group">
      				<label>@lang('site.stock')</label>
      				<input type="number" class="form-control" name="stock" value="{{old('stock')}}"  >
      			</div>

      			<div class="form-group">
      				<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
      			</div>
      		</form>
      	</div><!-- end of box body-->

      </div><!-- end of the box -->

@endsection
