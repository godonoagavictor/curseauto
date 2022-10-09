<?php

namespace App\Models;

use Whitecube\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class Itinerary extends Model implements HasMedia,  LocalizedUrlRoutable
{
    use HasSlug;
    use HasFactory;
    use InteractsWithMedia;
    use SortableTrait;
    use HasTranslations;
    use Notifiable;

    public $sluggable = 'title';

    public $translatable = [
        'title',
        'description',
        'slug',
        'price',
        'tour_text',
        'retour_text',
    ];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'country_id',
        'title',
        'description',
        'slug',
        'price',
        'tour_text',
        'retour_text',
        'itynerary_route',
        'itynerary_route_details',
        'status',
        'sort_order',
    ];

    public function getRouteKeyName()
    {
        return $this->slug;
    }

    public function getLocalizedRouteKey($locale)
    {
        return $this->getTranslation('slug', $locale);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug->' . app()->getLocale(), $value)->first();
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
