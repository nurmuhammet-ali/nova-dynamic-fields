```php
DynamicFields::make('Attributes', 'attributes')
    ->fields([
        ['type' => 'text', 'name' => 'Brand', 'label' => 'Label', 'required' => true, 'placeholder' => 'Adidas...', 'default' => 'default value'],
        ['type' => 'number', 'name' => 'B'],
        ['type' => 'select', 'name' => 'Colour', 'label' => 'Colour of product', 'options' => [
            ['label' => 'A', 'value' => 10],
            ['label' => 'B', 'value' => 19]
        ]]
    ])
```
