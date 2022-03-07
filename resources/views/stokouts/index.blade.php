@extends('layouts.master')

@section('title', 'Manage Stokouts')

@section('css')
    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Manage Stokouts</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"><i class="fa fa-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Manage Stokouts</li>
        </ol>
    </div>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Stokouts</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bstokouted table-hover" id="category-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>CC Project</th>
                        <th>Project</th>
                        <th>Supervisor</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>No. of Products</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stokouts as $stokout)
                        <tr data-index="{{$stokout['id']}}">
                            <td>{{$stokout['id']}}</td>
                            <td>{{$stokout['ccprojek']}}</td>
                            <th>{{$stokout['projek']}}</th>
                            <td>{{$stokout['supervisor']}}</td>
                            <td>{{$stokout['created_by']}}</td>
                            <td>{{$stokout['updated_by']}}</td>
                            <td>{{$stokout['no_of_products']}}</td>
                            <td>{{$stokout['created_at']}}</td>
                            <td class="text-center">
                                <a href="{{route('stokouts.show', $stokout['id'])}}" class="btn btn-info btn-xs m-r-5" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye font-14"></i></a>
                                <a href="{{route('stokouts.edit', $stokout['id'])}}" class="btn btn-primary btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></a>
                                <a href="{{route('stokouts.destroy', $stokout['id'])}}" class="btn btn-danger delete-stokout btn-xs m-r-5" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></a>
                            </td>
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
        });


        $(document).on('click', '.delete-stokout', function (e) {
            e.preventDefault();
            let isDelete = confirm('Do you really want to permanently delete this?');
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