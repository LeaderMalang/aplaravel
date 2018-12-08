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
                <li class="breadcrumb-item active"><a href="#">Profile</a></li>



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
                            <form class="form-horizontal" action="{{route('update')}}" method="post" enctype="multipart/form-data">
                            <div class="card">

                                <div class="card-header">

                                    <strong>Profile</strong> Details

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
                                            <label class="col-md-3 col-form-label" for="text-input">Full Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$user->name?$user->name:old('name')}}"  type="text" name="name" placeholder="Full Name" />
                                                @if ($errors->has('name'))
                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Email</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$user->email?$user->email:old('email')}}" type="text" name="email" placeholder="Email" />
                                                @if ($errors->has('email'))
                                                    <span class="help-block error">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Old Password</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="" type="password" name="oldpassword" placeholder="Password" />
                                                @if ($errors->has('oldpassword'))
                                                    <span class="help-block error">{{ $errors->first('oldpassword') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">New Password</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="" type="password" name="newpassword" placeholder="Password" />
                                                @if ($errors->has('newpassword'))
                                                    <span class="help-block error">{{ $errors->first('newpassword') }}</span>
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



