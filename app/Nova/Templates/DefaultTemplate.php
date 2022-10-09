<?php

namespace App\Nova\Templates;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use OptimistDigital\NovaPageManager\Template;
use Kraftbit\NovaTinymce5Editor\NovaTinymce5Editor;

class DefaultTemplate extends Template
{
    public static $type = 'page';
    public static $name = 'default-page';
    public static $seo = true;
    public static $view = 'default';

    public function fields(Request $request): array
    {
        return [
            NovaTinymce5Editor::make('Body', 'body')
                ->stacked(),
        ];
    }
}
