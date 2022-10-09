<?php

namespace App\Nova;

use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;

abstract class Resource extends NovaResource
{
    /**
     * Default sort order applied to resource
     */
    public static $defaultSort = [
        'id' => 'desc',
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (static::$defaultSort && empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return static::applyTranslation($query, array_keys(static::$defaultSort), function ($query, $column, $direction) {
                $query->orderBy($column, $direction);
            }, static::$defaultSort);
        }

        return $query;
    }

    /**
     * Build a Scout search query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Scout\Builder  $query
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(NovaRequest $request, $query)
    {
        return $query;
    }

    /**
     * Build a "detail" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query);
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return parent::relatableQuery($request, $query);
    }

    protected static function applyTranslation($query, $columns, $callback, $values = null)
    {
        $base = $query->getModel();
        $baseTable = $base->getTable();
        $attrs = [];
        if (method_exists($base, 'getTranslatableAttributes')) {
            $attrs = $base->getTranslatableAttributes();
        }
        $connectionType = $query->getModel()->getConnection()->getDriverName();
        foreach ($columns as $column) {
            if (! empty($attrs) && in_array($column, $attrs)) {
                if ($connectionType === 'pgsql') {
                    $nsColumn = DB::raw(
                        $baseTable.'.'.$column.'->>\''.app()->getLocale().'\''
                    );
                } else {
                    $nsColumn = DB::raw(
                        'LOWER(json_unquote(json_extract('.$baseTable.'.'.$column.', \'$."'.app()->getLocale().'"\')))'
                    );
                }
            } else {
                $nsColumn = $column;
            }
            if (isset($values)) {
                $callback($query, $nsColumn, $values[$column]);
            } else {
                $callback($query, $nsColumn);
            }
        }

        return $query;
    }

    /**
     * Apply the search query to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function applySearch($query, $search)
    {
        $connectionType = $query->getModel()->getConnection()->getDriverName();
        $likeOperator = $connectionType == 'pgsql' ? 'ilike' : 'like';

        $searchable = static::searchableColumns();
        if (empty($searchable)) {
            return $query;
        }

        $search = mb_convert_case($search, MB_CASE_LOWER);

        return static::applyTranslation($query, $searchable, function ($query, $column) use ($likeOperator, $search) {
            $query->orWhere($column, $likeOperator, '%'.$search.'%');
        });
    }

    /**
     * Apply any applicable orderings to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $orderings
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function applyOrderings($query, array $orderings)
    {
        $orderings = array_filter($orderings);

        if (empty($orderings)) {
            return empty($query->getQuery()->orders)
                ? $query->latest($query->getModel()->getQualifiedKeyName())
                : $query;
        }

        return static::applyTranslation($query, array_keys($orderings), function ($query, $column, $direction) {
            $query->orderBy($column, $direction);
        }, $orderings);
    }
}
