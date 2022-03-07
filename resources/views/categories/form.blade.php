<div class="page-content">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{isset($category) ? 'Edit' : 'Create'}} Category</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{isset($category) ? route('categories.update', $category['id']) : route('categories.store')}}" method="post" novalidate="novalidate" id="categoryForm" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif
                        <div class="form-group required row">
                            <label for="category_name" class="col-sm-3 col-form-label">Category Name:</label>
                            <div class="col-sm-9">
                                <input class="form-control {{\App\Utils\AppUtils::inputFieldError($errors, 'category_name')}}" name="category_name" value="{{isset($category) ? $category['category_name'] : old('category_name')}}" id="category_name" type="text" placeholder="Category Name">
                                @include('partials._error', ['field' => 'category_name'])
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary btn-block">{{isset($category) ? 'Update' : 'Create'}} Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>