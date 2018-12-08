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
                <li class="breadcrumb-item active"><a href="#">New Fiat Currency</a></li>



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
                            <form class="form-horizontal" action="{{route('currencies.fiat.store')}}" method="post" enctype="multipart/form-data">
                                <div class="card">

                                    <div class="card-header">

                                        <strong>Fiat Currency</strong> Details

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
                                                <input class="form-control" value="{{old('slug')}}"  type="text" name="slug" placeholder="slug" />
                                                @if ($errors->has('slug'))
                                                    <span class="help-block error">{{ $errors->first('slug') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Symbol</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('symbol')}}"  type="text" name="symbol" placeholder="Symbol" />
                                                @if ($errors->has('symbol'))
                                                    <span class="help-block error">{{ $errors->first('symbol') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="text-input">Exchange Rate</label>
                                            <div class="col-md-9">
                                                <input class="form-control" value="{{old('exchange_rate')}}"  type="number" name="exchange_rate" placeholder="Exchange Rate" />
                                                @if ($errors->has('exchange_rate'))
                                                    <span class="help-block error">{{ $errors->first('exchange_rate') }}</span>
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
        $('.alert').fadeOut('slow');
        }, 4000);
    @endsection
</div> <!-- #app -->

{{-- html foot section inclusive of closing body & html tag --}}
@include('coreui-static::partials.footer')



