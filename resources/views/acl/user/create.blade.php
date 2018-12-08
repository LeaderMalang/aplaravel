{{-- html head section inclusive of opening body tag --}}
@include('coreui-static::partials.header')

<!-- container for all content -->
<div id="app">

    {{-- Admin Bar --}}
    @include('coreui-static::partials.admin-bar')

    {{-- Required by Coreui --}}
    <div class="app-body">

    {{-- Sidebar --}}
    @include('coreui-static::partials.sidebar')

    <!-- Main content -->
        <main class="main">

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active"><a href="#">New User</a></li>



                <li class="breadcrumb-menu d-md-down-none">
                    <div class="btn-group" role="group" aria-label="Button group">
                        <a class="btn" href="#"><i class=""></i></a>
                        <a class="btn" href="#"><i class=""></i> &nbsp;Dashboard</a>
                        <a class="btn" href="#"><i class=""></i> &nbsp;Settings</a>
                    </div>
                </li>
            </ol>

            <!-- Page Content -->
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-6">
                            <form class="form-horizontal" action="{{route('store.user')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>User</strong> Details

                                    </div>
                                    @if(Session::has('success'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                                    @endif
                                    @if(Session::has('error'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                                    @endif
                                    <div class="card-body">

                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('name')}}"  type="text" name="name" placeholder="Name" />
                                                @if ($errors->has('name'))
                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Username</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('username')}}"  type="text" name="username" placeholder="UserName" />
                                                @if ($errors->has('username'))
                                                    <span class="help-block error">{{ $errors->first('username') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Email</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('name')}}"  type="text" name="email" placeholder="Email" />
                                                @if ($errors->has('email'))
                                                    <span class="help-block error">{{ $errors->first('email') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Select Role</label>
                                            <div class="col-md-9">
                                                <select name="role">
                                                    <option value="" selected>Select role</option>
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('role'))
                                                    <span class="help-block error">{{ $errors->first('role') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Password</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('name')}}"  type="password" name="password" placeholder="Password" />
                                                @if ($errors->has('password'))
                                                    <span class="help-block error">{{ $errors->first('password') }}</span>
                                                @endif

                                            </div>
                                        </div>




                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary" type="submit">
                                            <i class="fa fa-dot-circle-o"></i> Submit</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        {{-- Aside --}}
        @include('coreui-static::partials.aside')
    </div> <!-- .app-body -->

    {{-- Footer Bar --}}
    @include('coreui-static::partials.footer-bar')
    @section('footer-js')
        setTimeout(function() {
        $('.alert').fadeOut('slow');
        }, 4000);
    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')



