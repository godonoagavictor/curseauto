<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class MetaTag extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\MetaTag::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'route';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
        'description',
        'route',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            //            Images::make(__('Photo'), 'image')
            //                ->withResponsiveImages()
            //                ->enableExistingMedia()
            //                ->showStatistics(),

            Text::make(__('Route name'), 'route')
                ->sortable()
                ->readonly(),

            Text::make(__('Title'), 'title')
                ->sortable()
                ->translatable()
                ->rules(
                    'required',
                )
                ->placeholder(':title - news from our awesome website')
                ->help('Use :title only when there is a variable, like single news page, blog post, etc.'),

            Text::make(__('Description'), 'description')
                ->sortable()
                ->translatable()
                ->rules(
                    'required',
                )
                ->placeholder(':title - description from our awesome website')
                ->help('Use :title only when there is a variable, like single news page, blog post, etc.'),

            //            Text::make(__('H1'), 'H1')
            //                ->sortable()
            //                ->translatable()
            //                ->placeholder(':title - news title')
            //                ->help('Use :title only when there is a variable, like single news page, blog post, etc.'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Meta Tags');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Meta tag');
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    /**
 * Determine if this resource is available for navigation.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return bool
 */
//    public static function availableForNavigation(Request $request)
//    {
//        return false;
//    }
}
