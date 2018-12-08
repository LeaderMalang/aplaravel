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
                <li class="breadcrumb-item active"><a href="#">New Currency Pair</a></li>



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
                            <form class="form-horizontal" action="{{route('cepairs.update')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Currency Pair</strong> Details

                                    </div>

                                    <div class="card-body">

                                        @csrf
                                        <input type="hidden" name="id" value="{{$pair->id}}">

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Base Currency</label>
                                            <div class="col-md-9">
                                                <select id="base_currency"  name="c1" onchange="showAsset()" style="width: 100%;">
                                                    <option VALUE="0">Select Base Currency</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group row asset">
                                            <label class="col-md-3 col-form-label" for="text-input">Asset Currency</label>
                                            <div class="col-md-9">
                                                <select id="asset_currency" name="c2" onchange="showExchange()"  style="width: 100%;">
                                                    <option VALUE="0">Select Asset Currency</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group row exchange">
                                            <label class="col-md-3 col-form-label" for="text-input">Exchange</label>
                                            <div class="col-md-9">
                                                <select id="exchange" name="eid"  onchange="loadCode(this.value)" style="width: 100%;">
                                                    <option VALUE=" ">Select Exchange</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group row cc1" style="display: none">
                                            <label class="col-md-3 col-form-label" for="text-input">Base Currency Code</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value=""  type="text" name="cc1"  id="cc1" placeholder="Base Currency Code" />
                                                @if ($errors->has('cc1'))
                                                    <span class="help-block error">{{ $errors->first('cc1') }}</span>
                                                @endif
                                                <input type="hidden" name="cc1" id="cc1ID" />
                                            </div>
                                        </div>
                                        <div class="form-group row cc2" style="display: none">
                                            <label class="col-md-3 col-form-label" for="text-input">Asset Currency Code</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value=""  type="text"  id="cc2" placeholder="Asset Currency Code" />
                                                @if ($errors->has('cc2'))
                                                    <span class="help-block error">{{ $errors->first('cc2') }}</span>
                                                @endif
                                                <input type="hidden" name="cc2" id="cc2ID" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Status</label>
                                            <div class="col-md-9">
                                                <label class="switch switch-3d switch-success">
                                                    <input  type="checkbox" onclick="setValue()" class="switch-input" {{($pair->status==1)?"checked":""}} id="status" name="status" value="{{$pair->status}}">
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

        $(".asset").hide();
        $(".exchange").hide();
        function setValue(){
            if($("#status").is(':checked')){

                $("#status").val("1");
            }else {

                $("#status").val("0");
            }
        }
        $(document).ready(function() {
            $.noConflict();

            $.ajax({
                url:"loadCurrency",
                type:"GET",
                success:function(data){

                    jQuery.each(data, function(i, val) {

                    $("#base_currency").append("<option value='"+val.id+"'>"+val.name +"</option> ");

                    });
                    //$('#base_currency').select2();
                    $('#base_currency').select2().val(<?php echo $pair->c1;?>).trigger('change');
                }
            });
            $.ajax({
                url:"loadCurrency",
                type:"GET",
                success:function(data){

                    jQuery.each(data, function(i, val) {

                    $("#asset_currency").append("<option value='"+val.id+"'>"+val.name +"</option> ");

                    });
                   // $('#asset_currency').select2();
                    $('#asset_currency').select2().val(<?php echo $pair->c2;?>).trigger('change');
                    $.ajax({
                        url:"loadExchanges",
                        type:"GET",
                        success:function(data){

                        jQuery.each(data, function(i, val) {

                        $("#exchange").append("<option value='"+val.id+"'>"+val.name +"</option> ");

                        });
                        //$('#exchange').select2();
                        $('#exchange').select2().val(<?php echo $pair->eid;?>).trigger('change');
                        }
                    });
                }
            });

        });
        function showAsset(){
            $(".asset").show();
        }
        function showExchange(){
            $(".exchange").show();
        }
        function loadCode(eid){
            c1=$('#base_currency').select2().val();
            c2=$('#asset_currency').select2().val();
            if(c1 !=0&& c2 !=0){
                cc1=loadCurrencyCode(c1,eid,'cc1');
                cc2=loadCurrencyCode(c2,eid,'cc2');
                //console.log(cc1+"-"+cc2);


                $('.cc1').show();
                $('.cc2').show();
            }else {
                alert("Please Select Base and Asset Currency");
            }
        }
        function loadCurrencyCode(cid,eid,id){

            $.ajax({
                'url':'loadCurrencyCode',
                'type':'GET',
                'data':{'cid':cid,'eid':eid},
                'success':function(data){ console.log(data[0].code); $("#"+id).val(data[0].code); $("#"+id+"ID").val(data[0].id);}
            });

        }

    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')



