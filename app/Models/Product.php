<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public $attributes = [
        'image' => null,
        'rating' => null
    ];

    public $timestamps = false;

    public $guarded = [];

    protected function setUnitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = (double)($value);
    }

    public function getRouteKeyName()
    {
        return 'title';
    }

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
        $this->scopeCategory($query,$filters);
        $this->scopeSearch($query,$filters);
        $this->scopeSortBy($query,$filters);
        $this->scopePriceRange($query,$filters);

    }

    private function scopeCategory($query,array $filter)
    {
        $query->when($filter['category'] ?? false, function ($query){
            $query->whereHas('categories', function ($q){
                $q->where('name','=',request('category'));
            });
        });

    }

    private function scopeSearch($query,array $filters)
    {
        if ($filters['search'] ?? false){
            $query->where('title','like','%'.request('search').'%');
        }
    }

    private function scopeSortBy($query,array $filters)
    {
        if($filters['sortBy'] ?? false){
            $data = $this->sortBy($filters['sortBy']);
            $query->orderBy($data['column'],$data['sort']);
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

    private function scopePriceRange($query,array $filters)
    {
        if($filters['maxPrice'] ??  false){

            $min = ($filters['minPrice'] ?? false) ? $filters['minPrice'] : 0 ;

            if ($filters['maxPrice'] > $min){
                $query->whereBetween('unit_price',[$min,$filters['maxPrice']]);
            }
        }
    }


}
