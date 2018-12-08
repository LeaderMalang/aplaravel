{{-- html head section inclusive of opening body tag --}}
@include('coreui-static::partials.header')
<div class="container" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <h1>Register</h1>
                    <p class="text-muted">Create your account</p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Email">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Repeat password">
                    </div>

                    <button type="button" class="btn btn-block btn-success">Create Account</button>
                    <center>OR</center>
                    <a style="color:white" href="{{route('login')}}"> <button type="button" class="btn btn-block btn-success">Login </button></a>
                </div>
                {{--<div class="card-footer p-4">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-6">--}}
                            {{--<button class="btn btn-block btn-facebook" type="button">--}}
                                {{--<span>facebook</span>--}}
                            {{--</button>--}}
                        {{--</div>--}}
                        {{--<div class="col-6">--}}
                            {{--<button class="btn btn-block btn-twitter" type="button">--}}
                                {{--<span>twitter</span>--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')
