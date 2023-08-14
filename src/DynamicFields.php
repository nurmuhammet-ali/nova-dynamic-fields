<?php

namespace Nurmuhammet\DynamicFields;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\SupportsDependentFields;
use Laravel\Nova\Exceptions\NovaException;

class DynamicFields extends Field
{
    use SupportsDependentFields;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'dynamic-fields';

    /**
     * Specify that the element should be visible on the index view.
     *
     * @param  (callable():bool)|bool  $callback
     * @return $this
     *
     * @throws \Laravel\Nova\Exceptions\NovaException
     */
    public function showOnIndex($callback = true)
    {
        throw NovaException::helperNotSupported(__FUNCTION__, static::class);
    }

    /**
     * Fields to be rendered
     *
     * @param  array  $hues
     * @return $this
     */
    public function fields(array|callable $fields)
    {
        $fieldsForFrontEnd = $fields;
        if (is_callable($fields)) {
            $fieldsForFrontEnd = call_user_func($fields);
        }

        return $this->withMeta(['fields' => $fieldsForFrontEnd]);
    }

    /**
     * Fill with array name
     * 
     * @param  string $requestArrayName
     * @return $this
     */
    public function fillWithArrayName(string $requestArrayName = '')
    {
        return $this->withMeta(['fillWithArrayName' => $requestArrayName]);
    }
}
