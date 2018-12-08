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
                <li class="breadcrumb-item active"><a href="#">New Crypto Currency Detail</a></li>



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
                        <div class="col-12">
                            <form class="form-horizontal" action="{{route('currencies.cryptoDetails.storeDetails')}}" method="post" >
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Crypto Currency</strong> Details

                                    </div>

                                    <div class="card-body">

                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Currency Name</label>
                                            <div class="col-md-9">
                                                <select id="currency"  style="width: 100%;">
                                                    <option VALUE=" ">Select Currency</option>
                                                </select>
                                                <input type="hidden" name="currency_id" value="" id="cid">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Details Type</label>
                                            <div class="col-md-9">
                                                <select id="type" name="detail_type" style="width: 100%;">
                                                    <option VALUE=" ">Select Type</option>
                                                    <option VALUE="Website">Website</option>
                                                    <option value="Message Board">Message Board</option>
                                                    <option value="Source Code">Source Code</option>
                                                    <option value="Technical Documentation">Technical Documentation</option>
                                                    <option value="Explorer">Explorer</option>
                                                    <option value="Tags" >Tags</option>
                                                    <option value="Forum">Forum</option>
                                                    <option value="Announcement">Announcement</option>
                                                    <option value="Chat">Chat</option>
                                                </select>
                                                <input type="hidden" name="type" value="" id="detail_type">
                                            </div>
                                        </div>
                                        <div class="form-group row url">
                                            <label class="col-md-3 col-form-label" for="text-input">URL</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('else_url')}}"  type="url" name="else_url" placeholder="Enter URL" />
                                                @if ($errors->has('else_url'))
                                                    <span class="help-block error">{{ $errors->first('else_url') }}</span>
                                                @endif

                                            </div>
                                        </div>


                                        <div class="form-group row text">
                                            <label class="col-md-3 col-form-label" for="text-input">Text</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('tag_text')}}"  type="text" name="tag_text" placeholder="Enter Tag" />
                                                @if ($errors->has('tag_text'))
                                                    <span class="help-block error">{{ $errors->first('tag_text') }}</span>
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
            var selectType=$('#type').select2();
            $.ajax({
                url:"loadCurrency",
                type:"GET",
                success:function(data){

                    jQuery.each(data, function(i, val) {

                        $("#currency").append("<option value='"+val.id+"'>"+val.name +"</option> ");

                    });
                     $('#currency').select2();
                }
            });
            $('.text').hide();
            $('.url').show();
            $("#type").change(function(){
                if(this.value=="Tags"){
                    $('.text').show();
                    $('.url').hide();
                }else{
                    $('.text').hide();
                    $('.url').show();
                }
            });

            $('#currency').change(function(){
                $("#cid").val($(this).val());
            });
            $('#type').change(function(){
                $("#detail_type").val($(this).val());
            });
        });

    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')




