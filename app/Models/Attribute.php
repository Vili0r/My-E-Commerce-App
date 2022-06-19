<?php

namespace App\Models;

use App\Models\Scopes\LiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;
    use HasRecursiveRelationships;

    protected $fillable = [
        'product_id',
        'title',
        'price',
        'type',
        'sku',
        'parent_id',
    ];

    public function formattedPrice()
    {
        return money($this->price);
    }

    public function children()
    {
        return $this->hasMany(Attribute::class, 'parent_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withoutGlobalScope(LiveScope::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function inStock()
    {
        return $this->stockCount() > 0;
    }
    
    public function outOfStock()
    {
        return !$this->stockCount();
    }
    
    public function lowStock()
    {
        return !$this->outOfStock() && $this->stockCount() < 100;
    }

    public function stockCount()
    {
        return $this->descendantsAndSelf
            ->sum(fn ($attribute) => $attribute->stocks->sum('amount'));
    }
}
