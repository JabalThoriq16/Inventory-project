<div class="page-content">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{isset($product) ? 'Edit' : 'Create'}} Product</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{isset($product) ? route('products.update', $product['id']) : route('products.store')}}" method="post" novalidate="novalidate" id="productForm" enctype="multipart/form-data">
                        @csrf
                        @if(isset($product))
                            @method('PUT')
                        @endif
                        <div class="form-group required row">
                            <label for="product_name" class="col-sm-3 col-form-label">Product Name:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'product_name')}}" name="product_name" value="{{isset($product) ? $product['product_name'] : old('product_name')}}" id="product_name" type="text" placeholder="Product Name">
                                @include('partials._error', ['field' => 'product_name'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="product_code" class="col-sm-3 col-form-label">Product Code:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'product_code')}}" name="product_code" value="{{isset($product) ? $product['product_code'] : old('product_code')}}" id="product_code" type="text" placeholder="Product Code">
                                @include('partials._error', ['field' => 'product_code'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="category_id" class="col-sm-3 col-form-label">Category:</label>
                            <div class="col-sm-9">
                                <select class="form-control select2_select select2-hidden-accessible" name="category_id" id="category_id">
                                    <option></option>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}" {{isset($product) ? ($product['category_id'] == $cat->id ? 'selected' : '') : (old('category_id') == $cat->id ? 'selected' : '')}}>{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                                @include('partials._error', ['field' => 'category_id'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="jenis" class="col-sm-3 col-form-label">Jenis:</label>
                            <div class="col-sm-9">
                                <select class="form-control select2_select1 select2-hidden-accessible" name="jenis" id="jenis">
                                    <option></option>
                                    <option value="Inventory" {{isset($product) ? ($product['jenis'] == 'Inventory' ? 'selected' : '') : (old('jenis') == 'Inventory' ? 'selected' : '')}}>Inventory</option>
                                    <option value="Material" {{isset($product) ? ($product['jenis'] == 'Material' ? 'selected' : '') : (old('jenis') == 'Material' ? 'selected' : '')}}>Material</option>
                                    <option value="Aksessoris" {{isset($product) ? ($product['jenis'] == 'Aksessoris' ? 'selected' : '') : (old('jenis') == 'Aksessoris' ? 'selected' : '')}}>Aksessoris</option>
                                </select>
                                @include('partials._error', ['field' => 'jenis'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="product_slug" class="col-sm-3 col-form-label">Product Slug:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'product_slug')}}" name="product_slug" value="{{isset($product) ? $product['product_slug'] : old('product_slug')}}" id="product_slug" type="text" placeholder="Product Slug">
                                @include('partials._error', ['field' => 'product_slug'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="merek" class="col-sm-3 col-form-label">Merek:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'merek')}}" name="merek" value="{{isset($product) ? $product['merek'] : old('merek')}}" id="merek" type="text" placeholder="Merek">
                                @include('partials._error', ['field' => 'merek'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="warna" class="col-sm-3 col-form-label">warna:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'warna')}}" name="warna" value="{{isset($product) ? $product['warna'] : old('warna')}}" id="warna" type="text" placeholder="Warna">
                                @include('partials._error', ['field' => 'warna'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="dimensi" class="col-sm-3 col-form-label">Dimensi:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'dimensi')}}" name="dimensi" value="{{isset($product) ? $product['dimensi'] : old('dimensi')}}" id="dimensi" type="text" placeholder="Dimensi">
                                @include('partials._error', ['field' => 'dimensi'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="min" class="col-sm-3 col-form-label">Minimal Stok:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'min')}}" name="min" value="{{isset($product) ? $product['min'] : old('min')}}" id="min" type="text" placeholder="Minimal Stok">
                                @include('partials._error', ['field' => 'min'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="satuan" class="col-sm-3 col-form-label">Satuan:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'satuan')}}" name="satuan" value="{{isset($product) ? $product['satuan'] : old('satuan')}}" id="satuan" type="text" placeholder="Satuan (kg/m/lusin)">
                                @include('partials._error', ['field' => 'satuan'])
                            </div>
                        </div>
                        <div class="form-group required row">
                            <label for="product_image_picker" class="col-sm-3 col-form-label">Product Image:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'product_image')}}"  id="product_image_picker" type="file" accept=".png, .jpg">
                                <input type="text" style="position: absolute; z-index: -1" name="product_image" value="" id="product_image">
                                @include('partials._error', ['field' => 'product_image'])
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary btn-block">{{isset($product) ? 'Update' : 'Create'}} Product</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <img src="{{isset($product) ? $product['product_image'] : asset('assets/img/image.png')}}" class="img-fluid" id="productImagePreview" alt="product">
                </div>
            </div>
        </div>
    </div>
</div>