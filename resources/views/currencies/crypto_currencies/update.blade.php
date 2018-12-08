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
                <li class="breadcrumb-item active"><a href="#">New Crypto Currency</a></li>



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
                            <form class="form-horizontal" action="{{route('currencies.crypto.update')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Crypto Currency</strong> Details

                                    </div>

                                    <div class="card-body">

                                        @csrf
                                        <input type="hidden" name="cid" value="{{$crypto_currency->id}}">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$crypto_currency->name}}"  type="text" name="name" placeholder="Name" />
                                                @if ($errors->has('name'))
                                                    <span class="help-block error">{{ $errors->first('name') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Slug</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$crypto_currency->slug}}"  type="text" name="slug" placeholder="slug" />
                                                @if ($errors->has('slug'))
                                                    <span class="help-block error">{{ $errors->first('slug') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Symbol</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$crypto_currency->symbol}}"  type="text" name="symbol" placeholder="Symbol" />
                                                @if ($errors->has('symbol'))
                                                    <span class="help-block error">{{ $errors->first('symbol') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Select Currency Type</label>
                                            <div class="col-md-9">
                                                <select name="currency_type">
                                                    <option>Select Crypto Type</option>
                                                    <option value="Coin" {{($crypto_currency->currency_type=="Coin")?"Selected":""}}>Coin</option>
                                                    <option value="Token" {{($crypto_currency->currency_type=="Token")?"Selected":""}}>Token</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Circulating Supply</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$crypto_currency->circulating_supply}}"  type="number" name="circulating_supply" placeholder="Circulating Supply" />
                                                @if ($errors->has('circulating_supply'))
                                                    <span class="help-block error">{{ $errors->first('circulating_supply') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Max Supply</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$crypto_currency->max_supply}}"  type="number" name="max_supply" placeholder="Max Supply" />
                                                @if ($errors->has('max_supply'))
                                                    <span class="help-block error">{{ $errors->first('max_supply') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Total Supply</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$crypto_currency->total_supply}}"  type="number" name="total_supply" placeholder="Total Supply" />
                                                @if ($errors->has('total_supply'))
                                                    <span class="help-block error">{{ $errors->first('total_supply') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Ranking</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{$crypto_currency->ranking}}"  type="text" name="ranking" placeholder="Rank 1" />
                                                @if ($errors->has('ranking'))
                                                    <span class="help-block error">{{ $errors->first('ranking') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Mineable</label>
                                            <div class="col-md-9">
                                                <label class="switch switch-3d switch-success">
                                                    <input  name="mineable" id="mineable" type="checkbox" class="switch-input" {{$crypto_currency->mineable==1?"Checked":""}} value="{{$crypto_currency->mineable}}">
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Status</label>
                                            <div class="col-md-9">
                                                <label class="switch switch-3d switch-success">
                                                    <input  name="status" id="status" type="checkbox" class="switch-input" {{$crypto_currency->status==1?"Checked":""}} value="{{$crypto_currency->status}}">
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Image</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('cimage')}}"  type="file" name="cimage"  />
                                                <span class="help-block" > <img border="1px" style="border: 5px solid black;" src="{{asset("/assets/images/16X16/".$crypto_currency->logo)}}" /></span>
                                                <span class="help-block" > <img border="1px" style="border: 5px solid black;" src="{{asset("/assets/images/32X32/".$crypto_currency->logo)}}" /></span>
                                                @if ($errors->has('cimage'))
                                                    <span class="help-block error">{{ $errors->first('cimage') }}</span>
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
        $(function (){
            $("#status").change(function (){
                ckbox=$(this);
                if (ckbox.is(':checked')) {
                    ckbox.val(1);
                } else {
                    ckbox.val(0);
                }
            });
            $("#mineable").change(function (){
                ckbox=$(this);
                if (ckbox.is(':checked')) {
                    ckbox.val(1);
                } else {
                    ckbox.val(0);
                }
            });
        });

    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')




