<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Crayon\NovaLanguageEditor\NovaLanguageEditor;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Sloveniangooner\LocaleAnywhere\LocaleAnywhere;
use Silvanite\NovaToolPermissions\NovaToolPermissions;
use Statikbe\NovaTranslationManager\TranslationManager;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        if (\Illuminate\Support\Facades\Schema::hasTable('language_lines')) {
            $this->createSettingsFields();
        }
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        // Gate::define('viewNova', function ($user) {
        //     return in_array($user->email, [
        //         //
        //     ]);
        // });
    }

    /**
     * Get the cards that should be displayed on the default dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        $cards = [
            new \Tightenco\NovaGoogleAnalytics\PageViewsMetric,
            new \Tightenco\NovaGoogleAnalytics\VisitorsMetric,
            new \Tightenco\NovaGoogleAnalytics\MostVisitedPagesCard,
            new \Tightenco\NovaGoogleAnalytics\ReferrersList,
            new \Tightenco\NovaGoogleAnalytics\OneDayActiveUsersMetric,
            new \Tightenco\NovaGoogleAnalytics\SevenDayActiveUsersMetric,
            new \Tightenco\NovaGoogleAnalytics\FourteenDayActiveUsersMetric,
            new \Tightenco\NovaGoogleAnalytics\TwentyEightDayActiveUsersMetric,
            new \Tightenco\NovaGoogleAnalytics\SessionsMetric,
            new \Tightenco\NovaGoogleAnalytics\SessionDurationMetric,
            new \Tightenco\NovaGoogleAnalytics\SessionsByDeviceMetric,
            new \Tightenco\NovaGoogleAnalytics\SessionsByCountryMetric,
            // new \Llaski\NovaServerMetrics\Card,
            // put your custom cards here
        ];

        // add help card on dashboard for dev only
        if (config('app.env') !== 'production') {
            $cards[] = new Help();
        }

        return $cards;
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new NovaToolPermissions(),
            NovaLanguageEditor::make()->canSee(fn ($request) => $request->user()->roles->where('slug', 'super-administrator')->count()),
            new \Bernhardh\NovaTranslationEditor\NovaTranslationEditor(trans('Languages')),
            // new TranslationManager,
            // new \OptimistDigital\MenuBuilder\MenuBuilder,
            // new \Infinety\Filemanager\FilemanagerTool(),
            // new \ClassicO\NovaMediaLibrary\NovaMediaLibrary(),
            // new \Spatie\BackupTool\BackupTool(),
            // new \KABBOUCHI\LogsTool\LogsTool(),
            // new \Llaski\NovaScheduledJobs\NovaScheduledJobsTool,
            // new LocaleAnywhere([
            //     "locales" => [
            //         "en" => "English",
            //         "ro" => "Română",
            //         "ru" => "Русский",
            //     ],
            //     "useFallback" => false,
            // ]),
            // \Beyondcode\TinkerTool\Tinker::make()->canSee(fn ($request) => $request->user()->roles->where('slug', 'super-administrator')->count()),
            // \Sbine\RouteViewer\RouteViewer::make()->canSee(fn ($request) => $request->user()->roles->where('slug', 'super-administrator')->count()),
            // new \Christophrumpel\NovaNotifications\NovaNotifications(),
            new \OptimistDigital\NovaSettings\NovaSettings(),
            new \OptimistDigital\NovaPageManager\NovaPageManager()
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::serving(function (ServingNova $event) {
            if (Auth::check()) {
                $user = Auth::user();
                $prefix = $user->id;
                $locale_key = $prefix . '.locale';
                if (cache()->get($locale_key)) {
                    app()->setLocale(cache()->get($locale_key));
                }
            }
        });
    }

    protected function createSettingsFields(): void
    {
        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields(
            [
                Text::make('Phone', 'phone')
                    ->placeholder('+373 78 *** ***'),
                Text::make('Phone 2', 'phone_2')
                    ->placeholder('+373 78 *** ***'),
                Text::make('Email', 'email')
                    ->placeholder('Email'),

                Text::make('Instagram', 'instagram')
                    ->placeholder('Instagram'),
                Text::make('Facebook', 'facebook')
                    ->placeholder('Facebook'),
            ],
            [],
            'Contacts'
        );

        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields(
            [
                Image::make('Logo'),
                Image::make('Countries page breadcrumbs image'),
            ],
            [],
            'Default Images'
        );
    }
}
