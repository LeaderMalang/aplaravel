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
                <li class="breadcrumb-item active"><a href="#">Assign Permission List</a></li>



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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Assign Permission List
                                    <div style="float: right;" class=""><a href="{{route('permission.assign.torole')}}">Assign Permissions To Role</a> </div>
                                </div>
                                <div class="card-body">
                                    <table id='assignpermissionlist' class="table table-responsive-sm table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role</th>
                                            <th>Permission</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1;

                                        ?>


                                            @foreach($roleslist as $index=>$rolepermissions)
                                            <tr>
                                                <td>{{$i++}}</td>

                                                <td>{{$index}}</td>
                                                <td>
                                                <?php if(!empty($rolepermissions && count($rolepermissions)!=0)){?>
                                                @foreach($rolepermissions as $rolepermission)
                                                        <span class="badge badge-success">
                                                {{$rolepermission->name}}
                                                            </span>
                                                @endforeach
                                                 <?php }else {?>
                                                    <span class="badge badge-danger">No Permissions Assigned</span>

                                                <?php }?>
                                                </td>
                                                <td>
                                                    <a href="{{route('permission.assigntorole.edit',['name'=>$index])}}"><span class="badge badge-success">Edit</span></a>
                                                    <a href="{{route('permission.assigntorole.delete',['name'=>$index])}}"><span class="badge badge-danger">Delete</span></a>


                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

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

        $('#assignpermissionlist').DataTable();

    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')




