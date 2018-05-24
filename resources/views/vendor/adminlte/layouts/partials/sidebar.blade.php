<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    @if(Auth::user()->imagepath)
                        <img src="{{asset(Auth::user()->imagepath)}}" class="img-circle" alt="User Image">
                    @else
                        <img src="{{asset('img/avatar.png')}}" class="img-circle" alt="User Image">
                    @endif
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}
                    </a>
                </div>
            </div>
    @endif

    <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li {{ $rota_atual == 'home' ?  "class=active" : ""}}><a href="{{ url('home') }}"><i class='fa fa-home'></i>
                    <span class="info-menu">INÍCIO</span></a></li>
            @can('users')
            <li class="treeview">
                <a href="#"><i class='fa fa-plus'></i> <span class="info-menu">CADASTROS</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @can('users')
                        <li {{ $rota_atual == 'users' ?  "class=active" : ""}}><a href="{{ route('users.index') }}"><i
                                        class='fa fa-user-secret'></i> <span class="info-menu">USUÁRIOS</span></a></li>
                    @endcan
                    @can('clients')
                        <li {{ $rota_atual == 'clients' ?  "class=active" : ""}}><a href="{{ route('clients.index') }}"><i
                                        class='fa fa-male'></i> <span class="info-menu">CLIENTES</span></a></li>
                    @endcan
                    @can('products')
                        <li {{ $rota_atual == 'products' ?  "class=active" : ""}}><a
                                    href="{{ route('products.index') }}"><i
                                        class='fa fa-scissors'></i> <span class="info-menu">PRODUTOS</span></a></li>
                    @endcan
                </ul>
            @endcan
            @can('schedules')
                <li {{ $rota_atual == 'schedules' ?  "class=active" : ""}}><a href="{{ route('schedules.index') }}"><i
                                class='fa fa-calendar-check-o'></i> <span class="info-menu">AGENDAMENTOS</span></a></li>
            @endcan
            @can('cashflows')
                <li {{ $rota_atual == 'cashflows' ?  "class=active" : ""}}><a href="{{ route('cashflows.index') }}"><i
                                class='fa fa-dollar'></i> <span class="info-menu">FLUXO DE CAIXA</span></a></li>
            @endcan
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
