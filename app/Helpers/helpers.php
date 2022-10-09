<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists('get_translated_settings')) {
    function get_translated_settings($settingKey, $default = null, $locale = null)
    {
        if (!$locale) {
            $locale = app()->getLocale();
        }
        $value = json_decode(nova_get_setting($settingKey, $default), true);
        return isset($value[$locale]) ? $value[$locale] : $value[config('app.fallback_locale')];
    }
}

if (!function_exists('get_translation_by_page')) {

    /**
     * Return all page translations
     *
     * @param int|string|\App\Models\Page $page
     *
     * @return Collection
     */
    function get_translation_by_page($page)
    {
        switch (gettype($page)) {
            case 'integer':
                $page = \App\Models\Page::findOrFail($page);
                break;
            case 'string':
                $page = \App\Models\Page::where('slug', $page)->firstOrFail();
                break;
        }
        return \App\Models\Page::where('id', $page->locale_parent_id ?? $page->id)->orWhere('locale_parent_id', $page->locale_parent_id ?? $page->id)->get();
    }
}


if (!function_exists('static_route')) {

    /**
     * Returns Route to English slug
     *
     * @param string $slug English slug
     *
     * @return string Route
     */
    function static_route($slug, $targetLocale = null)
    {
        if (!$targetLocale)
            $targetLocale = app()->getLocale();

        // return pages collection from cache
        $pages = Cache::get('staticPages');

        // not stored yet, store now
        if (!$pages) {
            $pages = \App\Models\Page::get();
            Cache::put('staticPages', $pages, 600);
        }

        $pageBySlug = $pages->firstWhere('slug', $slug);

        if (!$pageBySlug) {
            return "";
        }

        // searched page is in current locale
        if ($pageBySlug->locale === $targetLocale)
            return route('frontend.static-page', $pageBySlug->slug);

        $page = $pages->filter(function ($page) use ($pageBySlug) {
            return ($page->id == $pageBySlug->locale_parent_id ?? $pageBySlug->id) || ($page->locale_parent_id == $pageBySlug->locale_parent_id ?? $pageBySlug->id);
        })
            ->where('locale', $targetLocale)
            ->first();
        return ($page) ? route('frontend.static-page', $page->slug) :  "#";
    }
}
