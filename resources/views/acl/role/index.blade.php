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
                <li class="breadcrumb-item active"><a href="#">Role List</a></li>



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
                                <div class="card-header">Role List
                                <div style="float: right;" class=""><a href="{{route('role.create')}}">Add New Role</a> </div>
                                </div>
                                <div class="card-body">
                                    <table id='roleList' class="table table-responsive-sm table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date registered</th>
                                            <th>Role</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1;?>
                                        @foreach($roles as $role)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$role->created_at}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                    <a href="{{route('role.edit',['id'=>$role->id])}}"><span class="badge badge-success">Edit</span></a>
                                                

                                                <a href="{{route('role.delete',['id'=>$role->id])}}"><span class="badge badge-danger">Delete</span></a>

                                                
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

        $('#roleList').DataTable();

    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')



