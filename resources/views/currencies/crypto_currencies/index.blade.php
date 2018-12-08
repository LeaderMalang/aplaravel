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
                <li class="breadcrumb-item active"><a href="#">Crypto Currencies List</a></li>



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
                                <div class="card-header">Crypto Currencies List
                                    <div style="float: right;" class=""><a href="{{route('currencies.crypto.create')}}">Add New Crypto Currency</a> </div>
                                </div>

                                <div class="card-body">
                                    <table id='fiat_currencies' class="table table-responsive-sm table-striped" style="width:100%">
                                        <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Circulating Supply</th>
                                            <th>Max Supply</th>
                                            <th>Total Supply</th>
                                            <th>Symbol</th>
                                            <th>Currency Type</th>
                                            <th>Mineable</th>
                                            <th>Ranking</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>

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
        $(document).ready(function(){
        $.noConflict();
        var data=<?php echo json_encode($crypto_currencie); ?>;
        var baseurl=window.location.href;
        $("#fiat_currencies").DataTable({
        "data": data,
        "columns" : [
        { "data" : "name" },
        { "data" : "circulating_supply" },
        { "data" : "max_supply" },
        { "data" : "total_supply" },
        { "data" : "symbol" },
        { "data" : "currency_type" },
        { "data" : "mineable",
            'render':function(val,_,obj){
                if(obj.mineable==1){
                    return '<span class="badge badge-success">Mineable</span>';
                }
                else {
                    return '<span class="badge badge-danger">Not Mineable</span>';
                }
            }

        },
        { "data" : "ranking" },
        { "data" : "status",
        'render':function(val,_,obj){
            if(obj.status==1){
            return '<label class="switch switch-3d switch-success"><input onclick="changeStatus(' + obj.id + ',' + obj.status + ')" type="checkbox" class="switch-input" checked value="' + obj.status + '"><span class="switch-label"></span><span class="switch-handle"></span></label>';}
            else {
        return '<label class="switch switch-3d switch-success"><input onclick="changeStatus(' + obj.id + ',' + obj.status + ')" type="checkbox" class="switch-input"  value="' + obj.status + '"><span class="switch-label"></span><span class="switch-handle"></span></label>';}

        }
        },
        { "data" : "id" ,
        'render': function(val, _, obj) {
        return '<a href="'+baseurl+'/edit?id=' + obj.id + '" ><span class="badge badge-success">Edit</span></a> <a href="'+baseurl+'/destory?id=' + obj.id + '" ><span class="badge badge-danger">Delete</span></a>' ;
        }
        }

        ]});

        //var fiat_currency=$('#fiat_currencies').DataTable();

        });
        //Change status of Currency
        function changeStatus(id,status){

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
        /* the route pointing to the post function */
        url: '/currencies/crypto/changeStatus',
        type: 'GET',
        /* send the csrf-token and the input to the controller */
        data: {_token: CSRF_TOKEN,cid:id,status:status},
        dataType: 'JSON',
        /* remind that 'data' is the response of the AjaxController */
        success: function (data) {
        console.log(data);



        }
        });
        }








    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')
