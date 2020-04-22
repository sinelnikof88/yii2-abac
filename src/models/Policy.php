<?php

namespace sinelnikof88\abac\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "policy".
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property string $date_create
 * @property string $date_update
 * @property int $is_delete
 */
class Policy extends \yii\db\ActiveRecord {

    public static function find() {
        return new ActiveQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'policy';
    }

    /**
     * primaryKey
     */
    public static function primaryKey() {
        return ['id'];
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('abac');
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['is_active', 'is_delete'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['name'], 'string', 'max' => 5000],
            [['description'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Название политики',
            'description' => 'Описание политики',
            'is_active' => 'Is Active',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'is_delete' => 'Is Delete',
        ];
    }

    public function getRules() {
        return $this->hasMany(Rule::className(), ['id' => 'rule_id'])->viaTable('policy_rule', ['policy_id' => 'id'], function ($query) {
                    $query->andWhere(['is', 'policy_rule.is_delete', null]);
                });
    }
    public function getActions() {
        return $this->hasMany(Action::className(), ['id' => 'action_id'])->viaTable('policy_action', ['policy_id' => 'id'], function ($query) {
                    $query->andWhere(['is', 'policy_action.is_delete', null]);
                });
    }

    public function getPolicyRules() {
        return $this->hasMany(PolicyRule::className(), ['policy_id' => 'id'], function ($query) {
                    $query->andWhere(['is', 'policy_rule.is_delete', null]);
                });
    }
    public function getPolicyElements() {
        return $this->hasMany(PolicyElement::className(), ['policy_id' => 'id'], function ($query) {
                    $query->andWhere(['is', 'policy_element.is_delete', null]);
                });
    }

    public function getPolicyActions() {
        return $this->hasMany(PolicyAction::className(), ['policy_id' => 'id'], function ($query) {
                    $query->andWhere(['is', 'policy_rule.is_delete', null]);
                });
    }

    public function getTarget() {
        return $this->hasMany(TargetRule::className(), ['policy_id' => 'id'], function ($query) {
                    $query->andWhere(['is', 'policy_rule.is_delete', null]);
                });
    }

    public function behaviors() {
        return [
            [
                'class' => \sinelnikof88\abac\behaviors\DeleteBehavior::class
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

}
