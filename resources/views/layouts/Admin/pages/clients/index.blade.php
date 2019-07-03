@extends('layouts.Admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.clients')</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->


            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.clients')</h3>
                    <small>{{$clients->total()}}</small>
                    <form method="GET" action="{{route('admin.clients.index')}}" >
                        <div class="row">
                            <div class="col-md-4">
                                <input class="form-control" name="search" type="text" placeholder="@lang('site.search')" value="{{(request()->search)}}">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if(auth()->user()->hasPermission('create_clients'))
                                    <a class="btn btn-primary" href="{{route('admin.clients.create')}}"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a class="btn btn-primary btn-sm disabled" href="#"><i class="fa fa-plus"></i> @lang('site.create')</a>
                                @endif
                            </div>
                        </div>
                    </form>
                    
                </div><!-- end of box header-->
                <div class="box-body">
                @if($clients->count() > 0)

                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $index=>$client)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{implode($client->phone , ' - ')}}</td>
                                    <td>{{$client->address}}</td>   
                                    <td>
                                        @if(auth()->user()->hasPermission('read_clients'))
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.clients.edit' , $client->id) }}"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a class="btn btn-primary btn-sm disabled" href="#"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                        @endif

                                        @if(auth()->user()->hasPermission('delete_clients'))
                                            <form action="{{ route('admin.clients.destroy',$client->id) }}" method="post" style="display: inline-block;">
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
                        {{$clients->appends(request()->query())->links()}}
                 @else
                    <h1>@lang('site.no_data_found')</h1>
                 @endif

                </div>
            </div>
     
@endsection
