@extends('layouts.Admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.products')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->


            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.products')</h3>
                    <small>{{$products->total()}}</small>
                    <form method="GET" action="{{route('admin.products.index')}}" >
                        <div class="row">
                            <div class="col-md-4">
                                <input class="form-control" name="search" type="text" placeholder="@lang('site.search')" value="{{(request()->search)}}">
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="category_id" type="text" placeholder="@lang('site.categories')">
                                <option value="" >@lang('site.all_categories')</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{request()->category_id == $category->id ? 'selected' : ''}} >  {{$category->name}}  </option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if(auth()->user()->hasPermission('create_products'))
                                    <a class="btn btn-primary" href="{{route('admin.products.create')}}"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a class="btn btn-primary btn-sm disabled" href="#"><i class="fa fa-plus"></i> @lang('site.create')</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div><!-- end of box header-->
                <div class="box-body">
                @if($products->count() > 0)

                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.category')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.profit_percent')</th>
                                <th>@lang('site.stock')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $index=>$product)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{!! $product->category->name !!}</td>
                                    <td><img style = " height:60px; "src="{{$product->image_path}}" alt=""></td>
                                    <td>{{$product->purchase_price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->profit_percent}} %</td>
                                    <td>{{$product->stock}}</td>    
                                    <td>
                                        @if(auth()->user()->hasPermission('read_products'))
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.products.edit' , $product->id) }}"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a class="btn btn-primary btn-sm disabled" href="#"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_products'))
                                            <form action="{{ route('admin.products.destroy',$product->id) }}" method="post" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>  @lang('site.delete')</button>
                                            </form>
                                        @else
                                            <a class="btn btn-danger btn-sm disabled" href="#"><i class="fa fa-trash"></i> @lang('site.delete')</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$products->appends(request()->query())->links()}}
                 @else
                    <h1>@lang('site.no_data_found')</h1>
                 @endif

                </div>
            </div>
     
@endsection
