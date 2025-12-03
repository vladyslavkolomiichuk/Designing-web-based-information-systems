<?php

namespace app\models;

use Yii;
use yii\mongodb\ActiveRecord;
use yii\web\UploadedFile;

class Patient extends ActiveRecord
{
  /**
   * @var UploadedFile|null For file upload
   */
  public $imageFile;

  public static function collectionName()
  {
    return 'patients';
  }

  // Specify attributes because MongoDB has no schema
  public function attributes()
  {
    return [
      '_id',
      'name',        // Full name
      'diagnosis',   // Diagnosis
      'birth_date',  // Birth date
      'photo',       // Path to photo
    ];
  }

  public function rules()
  {
    return [
      [['name', 'diagnosis', 'birth_date'], 'required'],
      [['name', 'diagnosis'], 'string', 'max' => 255],

      // Image validation
      [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
    ];
  }

  public function attributeLabels()
  {
    return [
      '_id' => 'ID',
      'name' => 'Patient Name',
      'diagnosis' => 'Diagnosis',
      'birth_date' => 'Birth Date',
      'imageFile' => 'Patient Photo',
    ];
  }

  // Method for saving the file
  public function upload()
  {
    // Check if file exists, validation already passed in controller
    if ($this->imageFile) {

      $folderPath = Yii::getAlias('@webroot') . '/uploads/';

      // Create folder if not exists
      if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true);
      }

      // Create file path
      $fileName = $this->imageFile->baseName . '.' . $this->imageFile->extension;
      $fullPath = $folderPath . $fileName;

      // Save file and update photo path in DB
      if ($this->imageFile->saveAs($fullPath)) {
        $this->photo = 'uploads/' . $fileName;
        return true;
      }
    }
    return false;
  }
}
