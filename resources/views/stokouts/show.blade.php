@extends('layouts.master')

@section('title', 'Stokout Detail')

@section('css')
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Stokout Detail</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Stokout Detail</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title d-flex w-100 justify-content-between">
                    <span>Stokout</span>
                    <a href="{{route('stokouts.edit', $stokout['id'])}}" class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Nama Project:</div>
                        <div class="col-md-7">{{$stokout['projek']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">CC:</div>
                        <div class="col-md-7">{{$stokout['ccprojek']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">No. of Product:</div>
                        <div class="col-md-7">{{$stokout['no_of_products']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Supervisor:</div>
                        <div class="col-md-7">{{$stokout['supervisor']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">No Hp:</div>
                        <div class="col-md-7">{{$stokout['nohp']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Created By:</div>
                        <div class="col-md-7">{{$stokout['created_by']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Updated By:</div>
                        <div class="col-md-7">{{$stokout['updated_by']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Created at:</div>
                        <div class="col-md-7">{{$stokout['created_at']}}</div>
                    </div>
                    <div class="col-md-4 row mb-3">
                        <div class="col-md-5 font-weight-bold">Updated at:</div>
                        <div class="col-md-7">{{$stokout['updated_at']}}</div>
                    </div>
                    <div class="col-md-6 row mb-3">
                        <div class="col-md-3 font-weight-bold">Alamat:</div>
                        <div class="col-md-7">{{$stokout['alamat']}}</div>
                    </div>
                </div>
                <h5 class="m-b-20 m-t-20"><i class="fa fa-cubes"></i>Item</h5>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stokout['products'] as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product['product_code']}}</td>
                            <th class="text-center">
                                <img class="img-fluid img-50" src="{{asset("storage/".$product['product_image'])}}">
                            </th>
                            <td>{{$product['product_name']}}</td>
                            <td>{{$product['category']}}</td>
                            <td>{{$product['merek']}}</td>
                            <th>{{$product['dimensi']}}</th>
                            <td>{{$product['quantity']}}</td>
                            <td>{{$product['satuan']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
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