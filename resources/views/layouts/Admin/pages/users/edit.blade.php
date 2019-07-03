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
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    @include('layouts.Admin.includes._errors')
                    <form action="{{route('admin.users.update' , $user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>@lang('site.first_name')</label>
                            <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.last_name')</label>
                            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" class="form-control image" name="image" >
                        </div>
                        <div class="form-group">
                            <img src="{{ $user->image_path }}" style="width:100px" class="img-thumbnail image-preview" >
                        </div>
                        <div class="form-group">
                            <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">

                                @php

                                    $maps=['create' , 'read' , 'update' , 'delete'];
                                    $models = ['users' , 'categories' , 'product'];

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
                                                <label><input type="checkbox" name="permissions[]" {{$user->hasPermission($map . '_' . $model) ? 'checked' : ''}} value="{{$map . '_' . $model}}"> @lang('site.'.$map)</label>
                                            @endforeach
                                        </div><!-- end of nav-tab -->
                                    @endforeach
                                </div><!-- end of nav-content -->
                            </div><!-- end of nav-tabs -->
                            <!-- nav-tabs-custom -->
                        </div><!-- end of form group -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>
                    </form>
                </div><!-- end of box body-->

            </div><!-- end of the box -->

@endsection
