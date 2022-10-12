<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if($filters['category'] ?? false)
        {
            $query->whereHas('categories', function ($q){
                $q->where('name','=',request('category'));
            });
        }

        if ($filters['search'] ?? false){
            $query->where('title','like','%'.request('search').'%');
        }

        if($filters['sortBy'] ?? false){

            $data = $this->sortBy($filters['sortBy']);
            $query->orderBy($data['column'],$data['sort']);
        }

        if($filters['maxPrice'] ??  false){

            $min = ($filters['minPrice'] ?? false) ? $filters['minPrice'] : 0 ;

            if ($filters['maxPrice'] > $min){
                $query->whereBetween('unit_price',[$min,$filters['maxPrice']]);
            }
        }

    }

    private function sortBy($sortOption)
    {
        switch ($sortOption){
            case "price-desc":
                return ['column' => 'unit_price','sort'=>'desc'];
            case "price":
                return ['column' => 'unit_price','sort'=>'asc'];
            case "title-desc":
                return ['column' => 'title','sort'=>'desc'];
            case "title":
                return ['column' => 'title','sort'=>'asc'];
        }
    }


}
