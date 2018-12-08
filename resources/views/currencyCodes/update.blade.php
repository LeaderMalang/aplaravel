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
                <li class="breadcrumb-item active"><a href="#">New Currency Code</a></li>



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
                            <form class="form-horizontal" action="{{route('currencyCode.update')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Currency Code</strong> Details

                                    </div>

                                    <div class="card-body">

                                        @csrf
                                        <input type="hidden" name="id" value="{{$currencyCode->id}}">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Currency</label>
                                            <div class="col-md-9">
                                                <select id="currency"  name="cid"  style="width: 100%;">
                                                    <option VALUE="0">Select Currency</option>
                                                </select>
                                                @if ($errors->has('cid'))
                                                    <span class="help-block error">{{ $errors->first('cid') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group row exchange">
                                            <label class="col-md-3 col-form-label" for="text-input">Exchange</label>
                                            <div class="col-md-9">
                                                <select id="exchange" name="eid"   style="width: 100%;">
                                                    <option VALUE=" ">Select Exchange</option>
                                                </select>
                                                @if ($errors->has('eid'))
                                                    <span class="help-block error">{{ $errors->first('eid') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row cc1" >
                                            <label class="col-md-3 col-form-label" for="text-input">Currency Code</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$currencyCode->code}}"  type="text" name="code"  id="cc1" placeholder="Currency Code" />
                                                @if ($errors->has('code'))
                                                    <span class="help-block error">{{ $errors->first('code') }}</span>
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

        $(document).ready(function() {
            $.noConflict();
            eid=<?php echo $currencyCode->eid; ?>;
            cid=<?php echo $currencyCode->cid; ?>;
            $.ajax({
                url:"loadCurrency",
                type:"GET",
                success:function(data){

                    jQuery.each(data, function(i, val) {

                    $("#currency").append("<option value='"+val.id+"'>"+val.name +"</option> ");

                    });
                    //$('#currency').select2();
                    $('#currency').select2().val(cid).trigger('change');
                }
            });

            $.ajax({
                url:"loadExchanges",
                type:"GET",
                success:function(data){

                    jQuery.each(data, function(i, val) {

                    $("#exchange").append("<option value='"+val.id+"'>"+val.name +"</option> ");

                    });
                    //$('#exchange').select2();
                    $('#exchange').select2().val(eid).trigger('change');
                }
            });
        });


    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')



