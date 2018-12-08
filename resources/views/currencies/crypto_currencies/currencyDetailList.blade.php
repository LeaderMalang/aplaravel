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
                <li class="breadcrumb-item active"><a href="#">Crypto Currencies Details List</a></li>



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
                                <div class="card-header">Crypto Currencies Details List
                                    <div style="float: right;" class=""><a href="{{route('currencies.cryptoDetails.createDetails')}}">Add New Crypto Currency Details</a> </div>
                                </div>

                                <div class="card-body">
                                    <table id='crypto_currenciesDetails' class="table table-responsive-sm table-striped display"  style="width:100%">
                                        <thead>
                                        <tr>

                                            <th>Currency Name</th>
                                            <th>Type</th>
                                            <th>URL</th>
                                            <th>TEXT</th>
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
            var data=<?php echo json_encode($currencyDetails); ?>;
            var baseurl=window.location.href;

            $("#crypto_currenciesDetails").DataTable({
                "data": data,
                "columns" : [
                { "data" : "name" },
                { "data" : "type" },
                { "data" : "url" },
                { "data" : "text" },
                { "data" : "id" ,
                'render': function(val, _, obj) {
                return '<a href="'+baseurl+'/editDetals?id=' + obj.id + '" ><span class="badge badge-success">Edit</span></a> <a href="'+baseurl+'/destoryDetals?id=' + obj.id + '" ><span class="badge badge-danger">Delete</span></a>' ;
                  }
                }

                ]});

        });









    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')
