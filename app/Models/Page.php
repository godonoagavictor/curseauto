<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use OptimistDigital\NovaPageManager\Models\Page as ModelsPage;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class Page extends ModelsPage implements HasMedia, LocalizedUrlRoutable
{
    use InteractsWithMedia;

    public function getLocalizedRouteKey($locale)
    {
        $translations = get_translation_by_page($this);
        if ($translations->firstWhere('locale', $locale)) {
            return $translations->firstWhere('locale', $locale)->slug;
        }
        return $this->slug;
    }


    public function getRouteKeyName()
    {
        return 'slug';
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
        return $this->where('slug', $value)->where('locale', app()->getLocale())->first();
    }
    public function getUriAttribute()
    {
        return route('frontend.page', $this->slug);
    }

    public function getTitleAttribute()
    {
        return [
            app()->getLocale() => $this->name
        ];
    }
}
