<?php

namespace sinelnikof88\abac\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use sinelnikof88\abac\models\Policy;

/**
 * PolicySearch represents the model behind the search form of `sinelnikof88\abac\models\Policy`.
 */
class PolicySearch extends Policy {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'is_active', 'is_delete'], 'integer'],
            [['name', 'date_create', 'date_update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Policy::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_active' => $this->is_active,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}
