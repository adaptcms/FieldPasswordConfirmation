<?php

namespace Adaptcms\FieldPasswordConfirmation\Field;

use Adaptcms\Base\Models\PackageField;
use Adaptcms\Base\Traits\EmptyColumnMigrations;
use Adaptcms\Fields\FieldType;

class FieldPasswordConfirmation extends FieldType
{
  use EmptyColumnMigrations;

  /**
  * @var array
  */
  public $defaultSettings = [
    'options' => [
      'is_sortable'        => false,
      'is_searchable'      => false,
      'is_required_create' => true,
      'is_required_edit'   => false
    ],
    'action_rules' => [
      'index'  => false,
      'create' => true,
      'edit'   => true,
      'show'   => false,
      'search' => false
    ]
  ];

  /**
  * @var boolean
  */
  public $shouldNotSetData = true;

  /**
  * Set Value
  *
  * @param mixed $value
  *
  * @return void
  */
  public function setValue($value)
  {
    return $value;
  }

  /**
  * Get Store Rules
  *
  * @param PackageField $packageField
  *
  * @return array
  */
  public function getStoreRules(PackageField $packageField)
  {
    $rules = [];

    // get password package field
    $field = PackageField::find($packageField->meta['passwordField']);

    if (!empty($field)) {
      $rules[] = 'same:' . $field->column_name;
      $rules[] = 'required_with:' . $field->column_name;
    }

    return $rules;
  }

  /**
  * Get Update Rules
  *
  * @param PackageField $packageField
  *
  * @return array
  */
  public function getUpdateRules(PackageField $packageField)
  {
    $rules = [];

    // get password package field
    $field = PackageField::find($packageField->meta['passwordField']);

    if (!empty($field)) {
      $rules[] = 'same:' . $field->column_name;
    }

    return $rules;
  }

  /**
  * Create Field Rules
  *
  * @return array
  */
  public function createFieldRules()
  {
    return [
      'meta.passwordField' => 'required'
    ];
  }

  /**
  * Update Field Rules
  *
  * @return array
  */
  public function updateFieldRules()
  {
    return [
      'meta.passwordField' => 'required'
    ];
  }
}
