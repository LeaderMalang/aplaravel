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
                <li class="breadcrumb-item active"><a href="#">Create Seeds</a></li>



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
                            <form class="form-horizontal" action="{{route('seeder.store')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Create Seeds of Tables</strong>

                                    </div>

                                    <div class="card-body">

                                        @csrf
                                        <?php $data=Session::get('data');?>
                                        @foreach($tableNames as $tableName)
                                            @if(isset($data['result'])&&count($data['result'])>0)
                                                @foreach($data['result'] as $tableres)

                                                    @if(isset($tableres['fail'])&&$tableName==$tableres['fail'])
                                                        <span class="badge badge-danger msg">{{"Unable to create seeds of ".$tableres['fail']}}</span>
                                                    @elseif(isset($tableres['success'])&&$tableName==$tableres['success'])
                                                        <span class="badge badge-success msg"> {{"Successfully created seeds of ".$tableres['success']}}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach



                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Select tables</label>
                                            <div class="col-md-9 col-form-label">
                                                @foreach($tableNames as $tableName)

                                                    <div class="form-check">

                                                        <input class="form-check-input" id="table" type="checkbox" value="{{$tableName}}" name="table[]" />
                                                        <label class="form-check-label" for="table">{{$tableName}}</label>
                                                    </div>

                                                @endforeach
                                                @if ($errors->has('table'))
                                                    <span class="help-block error">{{ $errors->first('table') }}</span>
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
        $('.msg').fadeOut('slow');
        }, 4000);
    @endsection

</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')




