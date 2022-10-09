<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Kraftbit\NovaTinymce5Editor\NovaTinymce5Editor;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Page extends Resource
{
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Page::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
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

            Images::make(__('Photo'), 'image')
                ->withResponsiveImages()
                ->enableExistingMedia()
                ->showStatistics()
                ->rules('required'),

            Text::make(__('Title'), 'title')
                ->sortable()
                ->rules(
                    'required',
                    'max:255'
                )
                ->placeholder('My awesome page')
                ->translatable(),

            Text::make(__('Short description'), 'short')
                ->translatable(),

            NovaTinymce5Editor::make('Body', 'body')
                ->stacked()
                ->translatable(),

            DateTime::make(__('Published from'), 'published_at')
                ->firstDayOfWeek(1)
                ->format('DD MMM YYYY hh:mm')
                ->pickerDisplayFormat('d.m.Y H:i'),
        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Static Pages');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Static Page');
    }
}
