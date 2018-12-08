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
                <li class="breadcrumb-item active"><a href="#">New Exchange</a></li>



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
                            <form class="form-horizontal" action="{{route('exchanges.store')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Exchange</strong> Details

                                    </div>

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
                                            <label class="col-md-3 col-form-label" for="text-input">Slug</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('slug')}}"  type="text" name="slug" placeholder="Slug" />
                                                @if ($errors->has('slug'))
                                                    <span class="help-block error">{{ $errors->first('slug') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">URL</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('url')}}"  type="url" name="url" placeholder="URL" />
                                                @if ($errors->has('url'))
                                                    <span class="help-block error">{{ $errors->first('url') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Fetch URL</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('fetch_url')}}"  type="url" name="fetch_url" placeholder="Fetch URL" />
                                                @if ($errors->has('fetch_url'))
                                                    <span class="help-block error">{{ $errors->first('fetch_url') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Has Fee</label>
                                            <div class="col-md-9">
                                            <label class="switch switch-3d switch-success">
                                                <input  type="checkbox" onclick="showFee()" id="has_fee" class="switch-input" name="has_fee" value="0">
                                                <span class="switch-label"></span>
                                                <span class="switch-handle"></span>
                                            </label>
                                                @if ($errors->has('has_fee'))
                                                    <span class="help-block error">{{ $errors->first('has_fee') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row fee">
                                            <label class="col-md-3 col-form-label" for="text-input">Fee</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('fee')}}"  step="any" type="number" name="fee" placeholder="Fee" />
                                                @if ($errors->has('fee'))
                                                    <span class="help-block error">{{ $errors->first('fee') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Status</label>
                                            <div class="col-md-9">
                                                <label class="switch switch-3d switch-success">
                                                    <input  type="checkbox" onclick="setValue()" class="switch-input" id="status" name="status" value="0">
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                                @if ($errors->has('status'))
                                                    <span class="help-block error">{{ $errors->first('status') }}</span>
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
        $(".fee").hide();
        //has fee to show Fee input
        function showFee(){

            if($("#has_fee").is(':checked')){
                $(".fee").show("slow");
                $("#has_fee").val("1");
            }else {
                $(".fee").hide("slow");
                $("#has_fee").val("0");
            }
        }
        function setValue(){
            if($("#status").is(':checked')){

                $("#status").val("1");
            }else {

                $("#status").val("0");
            }
        }
    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')



