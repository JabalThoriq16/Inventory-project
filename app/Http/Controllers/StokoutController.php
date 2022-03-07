<?php

namespace App\Http\Controllers;

use App\Http\Requests\StokoutFormRequest;
use App\Models\Product;
use App\Models\Stokout;
use App\Models\Supervisor;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StokoutController extends Controller {

    /**
     * @var Stokout
     */
    private $stokout;
    /**
     * @var Product
     */
    private $product;

    /**
     * StokoutController constructor.
     * @param Stokout $stokout
     * @param Product $product
     */
    public function __construct(Stokout $stokout, Product $product) {
        $this->stokout = $stokout;
        $this->product = $product;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $stokouts = $this->stokout->getStokouts(true);
        return view('stokouts.index', compact('stokouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $products = $this->product->getProducts();
        return view('stokouts.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StokoutFormRequest $request
     * @return void
     */
    public function store(StokoutFormRequest $request) {
        $fields = $request->validated();
        $data = $this->stokout->storeStokout($fields);
        return redirect()->route('stokouts.index')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $data = $this->stokout->getStokoutById($id);
        return view('stokouts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $data = $this->stokout->getStokoutById($id, true);
        $data['supervisors'] = Supervisor::get();
        $data['products'] = $this->product->getProducts();
        return view('stokouts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StokoutFormRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StokoutFormRequest $request, $id) {
        $fields = $request->validated();
        $data = $this->stokout->updateStokout($fields, $id);
        return redirect()->route('stokouts.index')->with( $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        $data = $this->stokout->destroyStokout($id);
        return json_encode($data);
    }

    /**
     * @param $id
     * @return false|string
     */
    public function deleteOrRestore($id){
        $data = $this->stokout->deleteOrRestore($id);

        return json_encode($data);
    }

    /**
     * return product form to stokouts form
     * @param $index
     * @return Factory|View
     */
    public function productForm($index){
        $products = $this->product->getProducts();
        return view('stokouts.product-form', [
            'products' => $products,
            'index' => $index
        ]);
    }
}
