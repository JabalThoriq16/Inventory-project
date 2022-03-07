<div class="page-content">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{isset($stokout) ? 'Edit' : 'Create'}} Stokout</div>
        </div>
        <div class="ibox-body">
            <form action="{{isset($stokout) ? route('stokouts.update', $stokout['id']) : route('stokouts.store')}}" method="post" id="stokoutForm">
                @csrf
                @if(isset($stokout))
                    @method('PUT')
                @endif
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="projek" class="col-sm-3 col-form-label">Nama Project:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'projek')}}" name="projek" value="{{isset($stokout) ? $stokout['projek'] : old('projek')}}" id="projek" type="text" placeholder="Nama Project">
                                @include('partials._error', ['field' => 'projek'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="ccprojek" class="col-sm-3 col-form-label">CC Project:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'ccprojek')}}" name="ccprojek" value="{{isset($stokout) ? $stokout['ccprojek'] : old('ccprojek')}}" id="ccprojek" type="text" placeholder="CC Project">
                                @include('partials._error', ['field' => 'ccprojek'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="supervisor" class="col-sm-3 col-form-label">Nama Supervisor:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'supervisor')}}" name="supervisor" value="{{isset($stokout) ? $stokout['supervisor'] : old('supervisor')}}" id="supervisor" type="text" placeholder="Nama Supervisor">
                                @include('partials._error', ['field' => 'supervisor'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="nohp" class="col-sm-3 col-form-label">Nomor Hp Supervisor:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'nohp')}}" name="nohp" value="{{isset($stokout) ? $stokout['nohp'] : old('nohp')}}" id="nohp" type="text" placeholder="08xxxxxxxxxxx">
                                @include('partials._error', ['field' => 'nohp'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'alamat')}}" name="alamat" value="{{isset($stokout) ? $stokout['alamat'] : old('alamat')}}" id="alamat" type="text" placeholder="Alamat">
                                @include('partials._error', ['field' => 'alamat'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required row">
                            {{-- <label for="total" class="col-sm-3 col-form-label">Total Price:</label> --}}
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'total')}}" name="total" value="{{isset($stokout) ? $stokout['total'] : old('total')}}" id="total" type="hidden" placeholder="Total Price">
                                @include('partials._error', ['field' => 'total'])
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-success add-product m-r-5" data-url="{{route('stokouts.productForm')}}" data-toggle="tooltip" data-original-title="Add Product"><i class="fa fa-plus font-14 mr-3"></i> Tambah Barang</a>
                    </div>
                    <div class="col-md-9"></div>
                    <!-- product rows start -->
                    <div class="col-12 bstokout-bottom-0 product-rows-start bstokout"></div>
                    @if(old('product_id'))
                        @foreach(old('product_id') as $key => $value)
                            @include('stokouts.product-form', ['index' => $key])
                        @endforeach
                    @elseif(isset($stokout))
                        @foreach($stokout['products'] as $key => $value)
                            @include('stokouts.product-form', ['index' => $key, 'prod' => $value])
                        @endforeach
                     @else
                        @include('stokouts.product-form', ['index' => 0])
                    @endif
                    <div class="col-12 bstokout-bottom-0 product-rows-end bstokout"></div>
                    <!-- product rows end -->
                    <div class="col-5 mt-3"></div>
                    <div class="col-md-5 mt-3">
                        <div class="form-group mb-0 row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary btn-block">{{isset($stokout) ? 'Update' : 'Create'}} Stokout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>