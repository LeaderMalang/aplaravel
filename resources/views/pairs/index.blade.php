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
                <li class="breadcrumb-item active"><a href="#">Currency Pairs List</a></li>



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
                                <div class="card-header">Currency Pairs List
                                    <div style="float: right;" class=""><a href="{{route('exchanges.create')}}">Add New Pair</a> </div>
                                </div>

                                <div class="card-body">
                                    <table id='currency_pairs' class="table table-responsive-sm table-striped display"  style="width:100%">
                                        <thead>
                                        <tr>

                                            <th>Base Currency</th>
                                            <th>Asset Currency</th>
                                            <th>Exchange</th>
                                            <th>Base Currency Code</th>
                                            <th>Asset Currency Code</th>
                                            <th>Status</th>
                                            <th>Actions</th>

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
            var data=<?php echo json_encode($pairs); ?>;
            var baseurl=window.location.href;

            $("#currency_pairs").DataTable({
                "data": data,
                "columns" : [
                    { "data" : "BaseCurrency" },
                    { "data" : "AssetCurrency" },
                    { "data" : "Exchange" },
                    { "data" : "BaseCurrencyCode" },
                    { "data" : "AssetCurrencyCode" },
                    {"data":"status",
                        'render':function(val,_,obj){
                            if(obj.status==1){
                                return ' <label class="switch switch-3d switch-success"><input  type="checkbox" onclick="changeStatus('+obj.id+')" class="switch-input" checked id="status" name="status" value="'+obj.status+'"><span class="switch-label"></span><span class="switch-handle"></span></label>';
                            }
                            else {
                                return ' <label class="switch switch-3d switch-success"><input  type="checkbox" onclick="changeStatus('+obj.id+')" class="switch-input"  id="status" name="status" value="'+obj.status+'"><span class="switch-label"></span><span class="switch-handle"></span></label>';
                            }
                        }
                    },
                    {"data":"id",
                        'render':function(val,_,obj){
                        return '<a href="'+baseurl+'/edit?id=' + obj.id + '" ><span class="badge badge-success">Edit</span></a> <a href="'+baseurl+'/destory?id=' + obj.id + '" ><span class="badge badge-danger">Delete</span></a>' ;
                        }
                    }

                ]
            });

        });
        function changeStatus(id){
            $.ajax({
                'url':'changeStatus',
                'type':'GET',
                'data':{'id':id},
                'success':function(data){
                    console.log(data);
                }
            });
        }









    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')
