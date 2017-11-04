<!-- Dropdown menu menu -->
<nav id="left-navigation" class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul style="width: 100%" class="nav navbar-nav">
                <li class="{!!classActivePath('home')!!}"><a href="{{ route('home') }}">Home</a></li>
                @if ($roles["is_manager"])
                    <li class="{!!classActivePath('assign.index')!!}"><a href="{{ route('assign.index') }}">Assign table to user</a></li>
                    <li class="{!!classActivePath('users.index')!!}"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="{!!classActivePath('tables.index')!!}"><a href="{{ route('tables.index') }}">Tables</a></li>
                    <li class="{!!classActivePath('products.index')!!}"><a href="{{ route('products.index') }}">Products</a></li>
                @elseif ($roles["is_waiter"])
                    <li class="{!!classActivePath('assign.index')!!}"><a href="{{ route('assign.index') }}">My Tables</a></li>
                    <li class="{!!classActivePath('orders.index')!!}"><a href="{{ route('orders.index') }}">Orders</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
