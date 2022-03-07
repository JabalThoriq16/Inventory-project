<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Exports\OpnameExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use Carbon\Carbon;
  

class OpnameController extends Controller
{
    public function index() {
    
        return view('opname.index');
    }

    public function product() {
        $category = Category::all();
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = Product::whereBetween('update_at',[$start_date,$end_date])->get();
        } else {
            $data = Product::latest()->get();
        }
        
        return view('opname.product', compact('data'));
    }

    public function export() 
    {
        return Excel::download(new OpnameExport, 'opname.xlsx');
    }

}