<div class="sidebar">
    <nav class="sidebar-nav">

        <!-- Navigation Items -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-tachometer"></i> Dashboard <span class="badge badge-info">NEW</span></a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link active" href="">User</a>--}}
            {{--</li>--}}

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> User Management</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('role.list')}}">
                            <i class="fa fa-shield" aria-hidden="true"></i>Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.list')}}">
                            <i class="fa fa-users" aria-hidden="true"></i>Manage Users </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('permission.list')}}">
                            <i class="fa fa-sitemap" aria-hidden="true"></i>Permissions</a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{route('role.user.list')}}">--}}
                             {{--Assign Roles to User</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('permission.assigntorole.list')}}">
                            <i class="fa fa-low-vision" aria-hidden="true"></i>Assign Permissions</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-money" aria-hidden="true"></i>Fiat Currency</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencies.fiat')}}">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>Fiat Currencies List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencies.fiat.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add Fiat Currencies</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-money" aria-hidden="true"></i>Crypto Currency</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencies.crypto')}}">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>Crypto Currencies List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencies.crypto.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add Crypto Currencies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencies.cryptoDetails')}}">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>Crypto Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencies.cryptoDetails.createDetails')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add Crypto Details</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-exchange" aria-hidden="true"></i>Exchange</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('exchanges.list')}}">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>Exchanges List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('exchanges.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add Exchange</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-code" aria-hidden="true"></i>Currency Codes</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencyCode.list')}}">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>Currency Code List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('currencyCode.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add Currency Code</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-gg-circle" aria-hidden="true"></i>Currency Pairs</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cepairs.list')}}">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>Currency Pairs List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cepairs.create')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>Add Currency Pairs</a>
                    </li>
                </ul>
            </li>
        <li class="nav-item"><a class="nav-link" href="{{route('seeder.creator')}}"><i class="fa fa-hdd-o" aria-hidden="true"></i> ISeeder</a> </li>

        </ul>
    </nav>

    <!-- Sidebar Navbar Minimizer -->
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
