<?php

namespace sinelnikof88\abac\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use sinelnikof88\abac\models\PolicyRule;

/**
 * PolicyRuleSearch represents the model behind the search form of `sinelnikof88\abac\models\PolicyRule`.
 */
class PolicyElementSearch extends PolicyElement
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_active', 'is_delete'], 'integer'],
            [['element_id', 'policy_id', 'variables', 'date_create', 'date_update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = PolicyElement::find();

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
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'is_active' => $this->is_active,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'element_id', $this->element_id])
            ->andFilterWhere(['like', 'policy_id', $this->policy_id])
            ->andFilterWhere(['like', 'variables', $this->variables]);

        return $dataProvider;
    }
}
