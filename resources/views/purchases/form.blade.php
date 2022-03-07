<div class="page-content">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{isset($purchase) ? 'Edit' : 'Create'}} Purchase</div>
        </div>
        <div class="ibox-body">
            <form action="{{isset($purchase) ? route('purchases.update', $purchase['id']) : route('purchases.store')}}" method="post" id="purchaseForm">
                @csrf
                @if(isset($purchase))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="supplier" class="col-sm-3 col-form-label">Supplier:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'supplier')}}" name="supplier" value="{{isset($purchase) ? $purchase['supplier'] : old('supplier')}}" id="supplier" type="text" placeholder="Supplier">
                                @include('partials._error', ['field' => 'supplier'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="nosurat" class="col-sm-3 col-form-label">No Surat Masuk:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'nosurat')}}" name="nosurat" value="{{isset($purchase) ? $purchase['nosurat'] : old('nosurat')}}" id="nosurat" type="text" placeholder="Nomor Surat">
                                @include('partials._error', ['field' => 'nosurat'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="nohp" class="col-sm-3 col-form-label">No Hp:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'nohp')}}" name="nohp" value="{{isset($purchase) ? $purchase['nohp'] : old('nohp')}}" id="nohp" type="text" placeholder="08xxxxxxxxxx">
                                @include('partials._error', ['field' => 'nohp'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'alamat')}}" name="alamat" value="{{isset($purchase) ? $purchase['alamat'] : old('alamat')}}" id="alamat" type="text" placeholder="Alamat"></textarea>
                                @include('partials._error', ['field' => 'alamat'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-success add-product m-r-5" data-url="{{route('purchases.productForm')}}" data-toggle="tooltip" data-original-title="Add Product"><i class="fa fa-plus font-14 mr-3"></i> Tambah Barang</a>
                    </div>
                    <!-- product rows start -->
                    <div class="col-12 border-bottom-0 product-rows-start border mt-3"></div>
                    @if(old('product_id'))
                        @foreach(old('product_id') as $key => $value)
                            @include('purchases.product-form', ['index' => $key])
                        @endforeach
                    @elseif(isset($purchase))
                        @foreach($purchase['products'] as $key => $value)
                            @include('purchases.product-form', ['index' => $key, 'prod' => $value])
                        @endforeach
                     @else
                        @include('purchases.product-form', ['index' => 0])
                    @endif
                    <div class="col-12 border-bottom-0 product-rows-end border"></div>
                    <!-- product rows end -->
                    <div class="col-md-5 mt-3">
                        <div class="col-md-12">
                            <div class="form-group required row">
                                <label for="total" class="col-sm-3 col-form-label">Total Price:</label>
                                <div class="col-sm-9">
                                    <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'total')}}" name="total" value="{{isset($purchase) ? $purchase['total'] : old('total')}}" id="total" type="number" placeholder="Total Price" readonly>
                                    @include('partials._error', ['field' => 'total'])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mt-3">
                        <div class="form-group mb-0 row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary btn-block">{{isset($purchase) ? 'Update' : 'Create'}} Purchase</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>