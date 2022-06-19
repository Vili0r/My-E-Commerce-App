<?php

namespace App\Models;

use App\Models\Scopes\FeaturedScope;
use App\Models\Scopes\LiveScope;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HasSlug, InteractsWithMedia;

    use Searchable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'live_at',
        'in_stock',
        'featured',
        'user_id',
        'image',
        'price'
    ];

    public static function booted()
    {
        static::addGlobalScope(new LiveScope());
        static::addGlobalScope(new FeaturedScope());
    }

    public function formattedPrice()
    {
        return money($this->price);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(200)
              ->height(200);

        $this->addMediaConversion('preview')
              ->width(400)
              ->height(400);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function toSearchableArray()
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'price' => $this->price,
            'category_ids' => $this->categories->pluck('id')->toArray(),
        ];
    }
}
