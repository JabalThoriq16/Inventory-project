@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <h1>DASHBOARD</h1>
    <hr>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $product->count() }}</h2>
                    <div class="m-b-5">PRODUCT</div><i class="ti-shopping-cart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>Banyak Daftar Product</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$product->where('jenis','Material')->count()}}</h2>
                    <div class="m-b-5">MATERIAL</div><i class="ti-bar-chart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>Banyak Daftar Material</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$product->where('jenis','Aksessoris')->count()}}</h2>
                    <div class="m-b-5">TOTAL AKSESSORIS</div><i class="fa fa-book widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>Banyak Daftar Aksessoris</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{$product->where('jenis','Inventory')->count()}}</h2>
                    <div class="m-b-5">INVENTORY</div><i class="fa fa-dropbox widget-stat-icon"></i>
                    <div><i class="fa fa-level-down m-r-5"></i><small>Banyak Daftar Inventory</small></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengingat stok mau habis --}}
    <div class="row justify-content-center">
        <div class="col-md-11">
            @foreach ($product as $item)
                @if ($item->where('jenis', 'Material')->get())
                    @if ($item['quantity'] <= $item['min'])
                        <div class="alert alert-danger alert-dismissible fade show text-light" role="alert">
                            <strong>Material {{ $item['product_name'] }}</strong> sudah limit segera Pesan! banyak item  <b>{{$item['quantity']}}</b>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dashboard_1_demo.js') }}" type="text/javascript"></script>
@endsection
