<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Specimen;

/**
 * SpecimenSearch represents the model behind the search form about `app\models\Specimen`.
 */
class SpecimenSearch extends Specimen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'specimenId', 'country', 'countryCodeIso', 'administrative_area_level_1', 'administrative_area_level_2', 'administrative_area_level_3', 'locality', 'sublocality', 'beginDate', 'endDate', 'legit', 'localityName', 'localityDescription', 'localityPrefix', 'localityMajorId', 'localityMinorId', 'mgrs', 'circumstance', 'wetherConditions', 'label', 'fieldsMeta'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['horizontalAccuracy', 'altitude', 'verticalAccuracy'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Specimen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'horizontalAccuracy' => $this->horizontalAccuracy,
            'altitude' => $this->altitude,
            'verticalAccuracy' => $this->verticalAccuracy,
            'beginDate' => $this->beginDate,
            'endDate' => $this->endDate,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'specimenId', $this->specimenId])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'countryCodeIso', $this->countryCodeIso])
            ->andFilterWhere(['like', 'administrative_area_level_1', $this->administrative_area_level_1])
            ->andFilterWhere(['like', 'administrative_area_level_2', $this->administrative_area_level_2])
            ->andFilterWhere(['like', 'administrative_area_level_3', $this->administrative_area_level_3])
            ->andFilterWhere(['like', 'locality', $this->locality])
            ->andFilterWhere(['like', 'sublocality', $this->sublocality])
            ->andFilterWhere(['like', 'legit', $this->legit])
            ->andFilterWhere(['like', 'localityName', $this->localityName])
            ->andFilterWhere(['like', 'localityDescription', $this->localityDescription])
            ->andFilterWhere(['like', 'localityPrefix', $this->localityPrefix])
            ->andFilterWhere(['like', 'localityMajorId', $this->localityMajorId])
            ->andFilterWhere(['like', 'localityMinorId', $this->localityMinorId])
            ->andFilterWhere(['like', 'mgrs', $this->mgrs])
            ->andFilterWhere(['like', 'circumstance', $this->circumstance])
            ->andFilterWhere(['like', 'wetherConditions', $this->wetherConditions])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'fieldsMeta', $this->fieldsMeta]);

        return $dataProvider;
    }

    // Overwrite magically behavoir of Specimen model and here especially beforeInsert
    public function behaviors()
    {
        return [];
    }
}
