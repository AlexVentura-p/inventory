<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $guarded = [];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lineItems() : HasMany
    {
        return $this->hasMany(LineItem::class);
    }

    public function updateTotals()
    {
        $lineItems = $this->lineItems();
        $thereIsRegular = $this->checkIfRegular();
        $totalItems = $lineItems->sum('quantity');
        $baseTotal = $lineItems->sum('item_total');
        if ($thereIsRegular) {
            $baseTotal += 3.99;
        }
        $tax = $baseTotal * 0.1;
        $total = $baseTotal + $tax;

        $this->item_count = $totalItems;
        $this->sub_total = $baseTotal;
        $this->taxes = $tax;
        $this->grand_total = $total;
        $this->update();
    }

    private function checkIfRegular() : bool
    {
        $lineItems = $this->lineItems()->getModels();
        foreach ($lineItems as $item){
            $id = $item->product_id;
            $product = Product::find($id);
            if ($product->type == "RegularProduct"){
                return true;
            }
        }
        return false;
    }
}
