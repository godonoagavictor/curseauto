<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Kraftbit\NovaTinymce5Editor\NovaTinymce5Editor;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Slider extends Resource
{
    use HasSortableRows;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Slider::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            ID::make(__('ID'), 'id')->sortable(),
            Images::make(__('Image'), 'image')
                ->withResponsiveImages()
                ->enableExistingMedia()
                ->showStatistics()
                ->rules('required')->required(),
            Text::make(__('Title'), 'title')->translatable()->sortable(),
            Text::make('Description', function () {
                return Str::limit(strip_tags($this->body), 50);
            })->onlyOnIndex(),
            NovaTinymce5Editor::make('Description', 'description')
                ->stacked()
                ->hideFromIndex()
                ->translatable(),
            Text::make(__('Link'), 'link')->hideFromIndex(),
            Boolean::make(__('Status'), 'status')
                ->sortable()
                ->help('If checked will be show'),

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
        return [];
    }
}
