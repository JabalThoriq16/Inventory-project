<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller{
    private $user;

    /**
     * HomeController constructor.
     * @param User $user
     */
    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        $product = Product::all();
        $purchase= Purchase::all();

        return view('dashboard',compact('product','purchase'));
    }
}
