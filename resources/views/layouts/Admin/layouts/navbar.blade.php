  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url ('/Admin')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> <span>@lang('site.dashboard')</span></a></li>
        @if(auth()->user()->hasPermission('read_categories'))
          <li><a href="{{route('admin.categories.index')}}"><i class="fa fa-th"></i> <span>@lang('site.categories')</span></a></li>
        @endif
        @if(auth()->user()->hasPermission('read_users'))
          <li><a href="{{route('admin.users.index')}}"><i class="fa fa-th"></i> <span>@lang('site.users')</span></a></li>
        @endif
        @if(auth()->user()->hasPermission('read_clients'))
          <li><a href="{{route('admin.clients.index')}}"><i class="fa fa-th"></i> <span>@lang('site.clients')</span></a></li>
        @endif
        @if(auth()->user()->hasPermission('read_products'))
          <li><a href="{{route('admin.products.index')}}"><i class="fa fa-th"></i> <span>@lang('site.products')</span></a></li>
        @endif
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>
