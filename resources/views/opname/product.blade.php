@extends('layouts.master')

@section('title', 'Manage Products')

@section('css')
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Stock Opname</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Dashboard</li>
        </ol>
    </div>
    <div class="row">
        @include('opname.formopname')
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">priode barang</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="category-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Gambar</th>
                        <th>Category</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Warna</th>
                        <th>Dimensi</th>
                        <th>Quantity</th>
                        <th>Satuan</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $data)
                        <tr data-index="{{$data['id']}}">
                            <th scope="row">{{ ++$key }}</th>
                            <td class="text-center">{{$data['product_code']}}</td>
                            <td>{{$data['product_name']}}</td>
                            <td class="text-center"><img class="img-fluid img-50" alt="category" src="{{asset("/storage/".$data['product_image'])}}"></td>
                            <td class="text-center">{{$data['category']['category_name']}}</td>
                            <td class="text-center">{{$data['jenis']}}</td>
                            <td class="text-center">{{$data['merek']}}</td>
                            <td class="text-center">{{$data['warna']}}</td>
                            <td class="text-center">{{$data['dimensi']}}</td>
                            <td class="text-center">{{$data['quantity']}}</td>
                            <td class="text-center">{{$data['satuan']}}</td>
                            <td class="text-center">{{$data['updated_at']}}</td>
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
        let dataTable = $('#category-table').DataTable({
            pageLength: 10,
            responsive: true
        });

        $(document).on('change', '.soft-delete-product', function (e) {
            let url = $(this).attr('data-url');

            $.get(url, function (response) {
                if (JSON.parse(response).status){
                    showToast('Success', JSON.parse(response).message, 'success');
                }else {
                    showToast('Error', JSON.parse(response).message, 'error');
                }
            })
        });

        $(document).on('click', '.delete-product', function (e) {
            e.preventDefault();
            let isDelete = confirm('Do you really want to permanently delete?');
            if (isDelete){
                let row = $(this).parents('tr');
                let url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function (response) {
                        if (JSON.parse(response).status){
                            showToast('Success', JSON.parse(response).message, 'success');
                            dataTable.row(row).remove().draw(false);
                        } else {
                            showToast('Error', JSON.parse(response).message, 'error');
                        }
                    }
                });
            }
        });
    </script>
@endsection