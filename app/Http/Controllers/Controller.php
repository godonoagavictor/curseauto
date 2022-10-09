<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $meta;

    protected $og;

    public function __construct(MetaInterface $meta)
    {
        $this->meta = $meta;

        $this->og = new \Butschster\Head\Packages\Entities\OpenGraphPackage('IGF');

        $metaTag = \App\Models\MetaTag::firstOrCreate(
            [
                'route' => Route::currentRouteName(),
            ],
            [
                'title' => [
                    'en' => get_translated_settings('app_name', config('app.name'), 'en'),
                    'ro' => get_translated_settings('app_name', config('app.name'), 'ro'),
                    'ru' => get_translated_settings('app_name', config('app.name'), 'ru'),
                ],
                'description' => [
                    'en' => get_translated_settings('app_name', config('app.name'), 'en'),
                    'ro' => get_translated_settings('app_name', config('app.name'), 'ro'),
                    'ru' => get_translated_settings('app_name', config('app.name'), 'ru'),
                ],
                'h1' => [
                    'en' => get_translated_settings('app_name', config('app.name'), 'en'),
                    'ro' => get_translated_settings('app_name', config('app.name'), 'ro'),
                    'ru' => get_translated_settings('app_name', config('app.name'), 'ru'),
                ],
            ]
        );

        $this->meta
            ->setTitle($metaTag->title)
            ->setDescription($metaTag->description)
            ->setFavicon(route('frontend.homepage') . '/favicon.ico');

        $this->og->setType('website')
            ->setSiteName(get_translated_settings('app_name', config('app.name'), app()->getLocale()))
            ->setTitle($metaTag->title)
            ->setDescription($metaTag->description);

        // set canonical and alternate hreflang links
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            if (app()->getLocale() !== $localeCode) {
                $this->meta->setHrefLang($localeCode, LaravelLocalization::getLocalizedURL($localeCode, null, []));
                $this->og->addAlternateLocale($properties['regional']);
            } else {
                $this->og->setLocale($properties['regional']);
            }
        }
        View::share('og', $this->og);
    }

    /**
     * Updates OpenGraph properties and re-register it
     *
     * @param  string  $functionName
     * @param  mixed  $value
     * @return void
     */
    public function updateOg(string $functionName, $value): void
    {
        if (method_exists($this->og, $functionName)) {
            $this->og->{$functionName}($value);
        }

        View::share('og', $this->og);
    }



    public function about()
    {
        return view('frontend.about');
    }


    public function contacts()
    {
        return view('frontend.contacts');
    }


    public function showPage(Page $page)
    {
        return view($page->template ? 'frontend.' . $page->template : 'frontend.page', compact('page'));
    }
}
