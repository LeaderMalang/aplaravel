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
                <li class="breadcrumb-item active"><a href="#">Fiat Currencies List</a></li>



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
                                <div class="card-header">Fiat Currencies List
                                    <div style="float: right;" class=""><a href="{{route('currencies.fiat.create')}}">Add New Fiat Currency</a> </div>
                                </div>

                                <div class="card-body">
                                    <table id='fiat_currencies' class="table table-responsive-sm table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Exchange Rate</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i=1?>

                                           @foreach($fiat_currencies as $fiat_currency)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$fiat_currency->name}}</td>
                                                <td>{{$fiat_currency->slug}}</td>
                                                <td id="{{$fiat_currency->slug}}">{{$fiat_currency->exchange_rate}}</td>

                                                <td>

                                                        <label class="switch switch-3d switch-success">
                                                            <input onclick="changeStatus({{$fiat_currency->id}},{{$fiat_currency->status}})" type="checkbox" class="switch-input" <?php if($fiat_currency->status==1) echo "checked"; ?> value="{{$fiat_currency->status}}">
                                                            <span class="switch-label"></span>
                                                            <span class="switch-handle"></span>
                                                        </label>


                                                </td>
                                                <td>
                                                    <a href="{{route('currencies.fiat.edit',['cid'=>$fiat_currency->id])}}"><span class="badge badge-success">Edit</span></a>
                                                    <a href="{{route('currencies.fiat.destory',['cid'=>$fiat_currency->id])}}"><span class="badge badge-danger">Delete</span></a>
                                                    <a href="#" onclick="updateRate('{{$fiat_currency->slug}}',{{$fiat_currency->id}})"><span class="badge badge-success">Fetch Rate</span></a>


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
        $(document).ready(function(){
            $.noConflict();


            var fiat_currency=$('#fiat_currencies').DataTable();

        });
        //Change status of Currency
        function changeStatus(id,status){

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: '/currencies/fiat/changeStatus',
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
        function updateRate(to,id){
            convert=`USD_${to}`;

            $.ajax({

                url: 'https://free.currencyconverterapi.com/api/v5/convert',
                type: 'GET',

                data: {'q':convert,'compact':'y'},
                dataType: 'JSON',

                success: function (data) {
                    //console.log(data[convert].val);
                    exchange_rate=data[convert].val;
                    $.ajax({
                        url:'/currencies/fiat/updateExchangeRate',
                        type:'GET',
                        data:{'exchange_rate':exchange_rate,cid:id},
                        success:function(data){
                            console.log(data);
                            $(`#${to}`).html(exchange_rate);
                        },
                        fail:function (error){
                            console.log(error);
                        }
                    });



                },
                fail:function (error){
                    console.log(error);
                }
            });
            return false;

        }







    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')
