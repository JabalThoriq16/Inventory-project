<?php

namespace App\Exports;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class OpnameExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $category = Category::all();
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = Product::whereBetween('update_at',[$start_date,$end_date])->get();
        } else {
            $data = Product::latest()->get();
        }
        
        return $data;
    }
}
