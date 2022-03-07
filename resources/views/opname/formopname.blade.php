<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4>Opname Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('opname.product') }}" method="GET">
                <div class="row">
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="start_date" />
                        <input type="date" class="form-control" name="end_date" />
                        <button class="btn btn-primary" type="submit">
                            Lihat
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4>Opname Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('opname.export') }}" method="GET">
                <div class="row">
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="start_date" />
                        <input type="date" class="form-control" name="end_date" />
                        <button class="btn btn-primary" type="submit">
                            cetak
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
