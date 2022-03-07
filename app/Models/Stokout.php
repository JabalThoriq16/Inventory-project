<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use RealRashid\SweetAlert\Facades\Alert;

class Stokout extends Model{

    use SoftDeletes;

    protected $fillable = [
        'created_by', 'updated_by', 'supervisor', 'total', 'projek', 'ccprojek', 'nosurat', 'nohp', 'alamat',
    ];

    // ===================== ORM Definition START ===================== //

    /**
     * @return BelongsToMany
     */
    public function products(){
        return $this->belongsToMany(Product::class, 'stokout_details')->withPivot('quantity', 'unit_price', 'sub_total');
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    // ===================== ORM Definition END ===================== //


    /**
     * @return array
     */
    public function format(){
        return [
            'id' => $this->id,
            'supervisor' => $this->supervisor,
            'projek' => $this->projek,
            'ccprojek' => $this->ccprojek,
            'nosurat' => $this->nosurat,
            'nohp' => $this->nohp,
            'alamat' => $this->alamat,
            'created_by' => $this->createdBy->name,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : '-',
            'no_of_products' => count($this->products),
            'total_quantity' => $this->products->sum('pivot.quantity'),
            'total' => $this->total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'products' => $this->products->map(function ($product){
                return [
                    'satuan'=>$product->satuan,
                    'warna'=>$product->warna,
                    'dimensi'=>$product->dimensi,
                    'merek'=>$product->merek,
                    'category'=>$product->category->category_name,
                    'product_image'=>$product->product_image,
                    'product_id' => $product->pivot->product_id,
                    'product_name' => $product->product_name,
                    'product_code' => $product->product_code,
                    'unit_price' => $product->pivot->unit_price,
                    'sale_price' => $product->sale_price,
                    'quantity' => $product->pivot->quantity,
                    'sub_total' => $product->pivot->sub_total,
                ];
            }),
        ];
    }

    /**
     * @param bool $withTrashed
     * @return Collection
     */
    public function getStokouts($withTrashed = false){
        $stokouts = $this->newQuery()
            ->when($withTrashed, function ($query){
                $query->withTrashed();
            })
            ->with(['products' => function($p){
                $p->withTrashed();
            }, 'createdBy' => function($c){
                $c->withTrashed();
            }])->get()->map(function ($stokout){
                return $stokout->format();
            });
        return $stokouts;
    }

    /**
     * @param $id
     * @param bool $withTrashed
     * @return array
     */
    public function getStokoutById($id, $withTrashed = false){
        $data = [];
        $stokout = $this->newQuery()
            ->where('id', $id)
            ->when($withTrashed, function ($query){
                $query->withTrashed();
            })
            ->with(['products' => function($p){
                $p->withTrashed();
            }, 'createdBy' => function($c){
                $c->withTrashed();
            }])->firstOrFail()->format();
        if ($stokout){
            $data['status'] = true;
            $data['stokout'] = $stokout;
        }else{
            $data['status'] = false;
            $data['stokout'] = [];
        }
        return $data;
    }

    /**
     * @param array $fields
     * @return array
     */
    public function storeStokout(array $fields) {
        $data = [];
        $fields['created_by'] = auth()->id();
        $stokout = $this::create($fields);
        if ($stokout){
            $totalPrice = 0;
            $data['status'] = true;
            $data['message'] = "New stokout was added";
            for ($i = 0; $i < count($fields['product_id']); $i ++){
                $quantity = $fields['quantity'][$i];
                $unitPrice = $fields['unit_price'][$i];
                $subTotal = $quantity * $unitPrice;
                $totalPrice += $subTotal;
                // dd(Product::findOrFail($fields['product_id'][$i])->quantity);
                
                // decrement product quantity
                if (Product::findOrFail($fields['product_id'][$i])->quantity>=$quantity) {
                    Product::findOrFail($fields['product_id'][$i])->decrement('quantity', $quantity);

                    // add product stokout detail in stokout_details table
                     $stokout->products()->attach($fields['product_id'][$i], [
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'sub_total' => $subTotal
                     ]);
                
                    $stokout->total = $totalPrice;
                    $stokout->save();

                }
                else {
                    Alert::warning('Form tidak berhasil dibuat', 'barang kurang');
                    $stokout->delete($fields);
                    break;
                }
                
            }
        }else{
            $data['status'] = false;
            $data['message'] = "There is problem adding stokout";
        }
        return $data;
    }

    /**
     * @param array $fields
     * @param int $id
     * @return mixed
     */
    public function updateStokout(array $fields, int $id) {
        $stokout = $this::findOrFail($id);

        foreach ($stokout->products()->get() as $product){
            $product->decrement('quantity', $product->pivot->quantity);
        }
        // detach all products against this stokout
        $stokout->products()->detach();
        // attach products with stokout again
        $totalPrice = 0;
        for ($i = 0; $i < count($fields['product_id']); $i ++){
            $quantity = $fields['quantity'][$i];
            $unitPrice = $fields['unit_price'][$i];
            $subTotal = $quantity * $unitPrice;
            $totalPrice += $subTotal;
            // increment product quantity
            Product::findOrFail($fields['product_id'][$i])->decrement('quantity', $quantity);
            // add product stokout detail in stokout_details table
            $stokout->products()->attach($fields['product_id'][$i], [
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'sub_total' => $subTotal
            ]);
        }
        $fields['total'] = $totalPrice;
        $fields['updated_by'] = auth()->id();
        $stokout->update($fields);

        $data['status'] = true;
        $data['message'] = "Stokout was updated";

        return $data;
    }

    /**
     * @param int $id
     * @return array
     */
    public function destroyStokout(int $id) {
        $stokout = $this::withTrashed()->findOrFail($id);
        foreach ($stokout->products()->get() as $product){
            $product->decrement('quantity', $product->pivot->quantity);
        }
        $data = [];
        if ($stokout->forceDelete()){
            $data['status'] = true;
            $data['message'] = "Stokout was deleted";
        }else{
            foreach ($stokout->products()->get() as $product){
                $product->increment('quantity', $product->pivot->quantity);
            }
            $data['status'] = false;
            $data['message'] = "There is problem deleting stokout";
        }

        return $data;
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteOrRestore($id) {
        $data = [];
        $stokout = $this::withTrashed()->findOrFail($id);
        if ($stokout){
            if ($stokout->trashed()){
                $stokout->restore();
            }else{
                try {
                    $stokout->delete();
                } catch (Exception $e) {
                }
            }
            $data['status'] = true;
            $data['message'] = "Stokout status was updated";
        }else {
            $data['status'] = false;
            $data['message'] = "Stokout not found";
        }

        return $data;
    }
}
