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
                <li class="breadcrumb-item active"><a href="#">Update Assigned Roles</a></li>



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
                            <form class="form-horizontal" action="{{route('role.assignuser.update')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Update Assigned Roles</strong> To User

                                    </div>

                                    <div class="card-body">

                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Select User</label>
                                            <div class="col-md-9">
                                                <select name="user">
                                                    <option value="" selected>Select User</option>
                                                    @foreach($users as $user1)
                                                        <option value="{{$user1->id}}" {{($user1->id==$user->id)?'selected':''}}>{{$user1->name}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has('user'))
                                                    <span class="help-block error">{{ $errors->first('user') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Roles</label>
                                            <div class="col-md-9 col-form-label">


                                                @foreach($roles as  $index=>$role)
                                                    <div class="form-check">



                                                        <input class="form-check-input"
                                                               <?php
                                                               foreach ($userRoles as $userRole){
                                                                   if($role==$userRole){
                                                                       echo "checked";
                                                                   }

                                                               }





                                                               ?>


                                                               id="radio1" type="checkbox" value="{{$role}}" name="role[]" />
                                                        <label class="form-check-label" for="radio1">{{$role}}</label>
                                                    </div>
                                                @endforeach
                                                @if ($errors->has('role'))
                                                    <span class="help-block error">{{ $errors->first('role') }}</span>
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




