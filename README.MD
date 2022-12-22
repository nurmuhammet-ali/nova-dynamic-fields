# Nova Dynamic fields

##### Dynamic fields for nova. Will fill resource attributes with given name. Can be very useful even for the many to many relationships. Supports dependent fields.

## Requirements
- `php: >=8.0`
- `laravel/nova: ^4.0`

## Installation

Install the package in a Laravel Nova project via Composer:

```bash
# Install nova-inputmask
composer require nurmuhammet/nova-dynamic-fields
```

## Usage

```php
use Nurmuhammet\DynamicFields\DynamicFields;

// ...
DynamicFields::make('Attributes', 'attributes')
    ->fields([
        ['type' => 'text', 'name' => 'Brand', 'label' => 'Label', 'required' => true, 'placeholder' => 'Adidas...', 'default' => 'default value'],
        ['type' => 'number', 'name' => 'B'],
        ['type' => 'select', 'name' => 'Colour', 'label' => 'Colour of product', 'options' => [
            ['label' => 'A', 'value' => 10],
            ['label' => 'B', 'value' => 19]
        ]]
    ])
    
    ->fillWithArrayName('names') // if you want form name should be array, like: `names[]`
```

### ```fields(array|callable $fields)```
#### If closure is passed, the array have to be returned by closure
| Attribute | type  | required | default |
|   :---:   | :---: |  :---:   |  :---:  |
| `name`  |  `string`  | `yes` |  |
| `type`  |  `string`, valid input types: `text`, `number`, `select`  | `yes` |  |
| `label` |  `string`, `integer`...  | `no`  | `name` will be capitalized |
| `default` |  `string`, `integer`... | `no`  | `null` |
| `options` |  `array`, returned array must have `label` & `value` keys, example: `[['label' => 'Field label', 'value' => 'field value'], ...]`  | `no`  | `null` |
| `required` |  `bool` | `no`  | `false` |
| `placeholder` |  `string, integer`... | `no`  | `''` |

---

### ```fillWithArrayName(string $requestArrayName = '')```
#### Fills all fields with names & values into one array
