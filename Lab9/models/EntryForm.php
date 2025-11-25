<?php

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
  public $name;   // User name
  public $email;  // User email

  public function rules()
  {
    return [
      [['name', 'email'], 'required'],           // Required fields
      [['name', 'email'], 'trim'],               // Trim whitespace
      ['name', 'string', 'min' => 2, 'max' => 50], // Name length
      ['email', 'email'],                        // Email format
    ];
  }
}
