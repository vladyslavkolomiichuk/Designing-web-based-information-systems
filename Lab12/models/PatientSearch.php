<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PatientSearch extends Patient
{
  public function rules()
  {
    // Fields allowed for searching
    return [
      [['_id', 'name', 'diagnosis', 'birth_date'], 'safe'],
    ];
  }

  public function search($params)
  {
    $query = Patient::find();

    // Configure data provider (pagination, query)
    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => ['pageSize' => 10],
    ]);

    // Load search parameters
    $this->load($params);

    // If validation failed, return unfiltered data
    if (!$this->validate()) {
      return $dataProvider;
    }

    // Filtering (LIKE - partial match)
    $query->andFilterWhere(['like', 'name', $this->name])
      ->andFilterWhere(['like', 'diagnosis', $this->diagnosis]);

    return $dataProvider;
  }
}
