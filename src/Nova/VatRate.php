<?php

namespace Wame\LaravelNovaVatRate\Nova;

use App\Nova\Resource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use ShuvroRoy\NovaTabs\Tab;
use ShuvroRoy\NovaTabs\Tabs;
use ShuvroRoy\NovaTabs\Traits\HasTabs;
use Wame\LaravelNovaCountry\Nova\Country;
use Wame\LaravelNovaVatRate\Enums\VatRateTypeEnum;

class VatRate extends Resource
{
    use HasTabs;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\VatRate::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static string|array $title = ['type', ' ', 'value', '%'];

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static array $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Tabs::make(__('vat_rate.detail', ['title' => $this->title]), [
                Tab::make(__('vat_rate.singular'), [
                    ID::make()->onlyOnForms(),

                    BelongsTo::make(__('vat_rate.field.country'), 'country', Country::class)
                        ->help(__('vat_rate.field.country.help'))
                        ->withSubtitles()
                        ->withoutTrashed()
                        ->showCreateRelationButton()
                        ->sortable()
                        ->filterable()
                        ->required()
                        ->rules('required')
                        ->showOnPreview(),

                    Select::make(__('vat_rate.field.type'), 'type')
                        ->help(__('vat_rate.field.type.help'))
                        ->options(VatRateTypeEnum::toArray())
                        ->displayUsing(fn () => VatRateTypeEnum::from($this->type)->title())
                        ->searchable()
                        ->sortable()
                        ->filterable()
                        ->required()
                        ->rules('required')
                        ->showOnPreview(),

                    Number::make(__('vat_rate.field.value'), 'value')
                        ->help(__('vat_rate.field.value.help'))
                        ->displayUsing(fn () => $this->value . ' %')
                        ->min(0)
                        ->max(100)
                        ->step(1)
                        ->sortable()
                        ->filterable()
                        ->required()
                        ->rules('required')
                        ->showOnPreview(),
                ]),
            ])->withToolbar(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

}
