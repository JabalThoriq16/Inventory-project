@extends('layouts.master')

@section('title', 'Purchase Detail')

@section('css')
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Purchase Detail</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Purchase Detail</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title d-flex w-100 justify-content-between">
                    <span>Purchase</span>
                    <a href="{{route('purchases.edit', $purchase['id'])}}" class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Supplier:</div>
                        <div class="col-md-7">{{$purchase['supplier']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Created By:</div>
                        <div class="col-md-7">{{$purchase['created_by']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Updated By:</div>
                        <div class="col-md-7">{{$purchase['updated_by']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">No. of Product:</div>
                        <div class="col-md-7">{{$purchase['no_of_products']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Created at:</div>
                        <div class="col-md-7">{{$purchase['created_at']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Updated at:</div>
                        <div class="col-md-7">{{$purchase['updated_at']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">No Surat Masuk:</div>
                        <div class="col-md-7">{{$purchase['nosurat']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">No Hp Supplier:</div>
                        <div class="col-md-7">{{$purchase['nohp']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Alamat Supplier:</div>
                        <div class="col-md-7">{{$purchase['alamat']}}</div>
                    </div>
                </div>
                <h6 class="m-b-20 m-t-20"><i class="fa fa-cubes"></i>Products</h6>
                <table id="products-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Code</th>
                        <th>Gambar</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Merek</th>
                        <th>Dimensi</th>
                        <th>Quantity</th>
                        <th>Satuan</th>
                        <th>Purchase Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase['products'] as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product['product_code']}}</td>
                            <th><img class="img-fluid img-50" src="{{asset("storage/".$product['product_image'])}}"></th>
                            <td>{{$product['product_name']}}</td>
                            <td>{{$product['category']}}</td>
                            <td>{{$product['merek']}}</td>
                            <th>{{$product['dimensi']}}</th>
                            <td>{{$product['quantity']}}</td>
                            <td>{{$product['satuan']}}</td>
                            <td>{{$product['unit_price']}}</td>
                            <td>{{$product['sub_total']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="10"></th>
                        {{-- <th>{{$purchase['total_quantity']}}</th> --}}
                        {{-- <th colspan="2"></th> --}}
                        <th>{{$purchase['total']}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/js/datatables.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        let dataTable = $('#products-table').DataTable({
            pageLength: 10,
        });
    </script>
@endsection