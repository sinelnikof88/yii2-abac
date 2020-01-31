<?php

namespace sinelnikof88\abac\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "policy_rule".
 *
 * @property int $id
 * @property string $action_id
 * @property string $policy_id
 * @property array $variables
 * @property string $date_create
 * @property string $date_update
 * @property int $is_active
 * @property int $is_delete
 */
class PolicyAction extends \yii\db\ActiveRecord {

    public static function find() {
        return new ActiveQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'policy_action';
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
            [['variables', 'date_create', 'date_update'], 'safe'],
            [['is_active', 'is_delete'], 'integer'],
            [['action_id', 'policy_id'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'action_id' => 'action ID',
            'policy_id' => 'Policy ID',
            'variables' => 'Variables',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'is_active' => 'Is Active',
            'is_delete' => 'Is Delete',
        ];
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

    public function getActionList() {
        $oldActionIds = PolicyAction::find()->where(['policy_id' => $this->policy_id])->andWhere(['is', 'is_delete', null])->asArray()->select(['action_id'])->column();
        $models = Action::find()->where(['not in', 'id', $oldActionIds])->all();
        $list = \common\components\ArrayHelper::map($models, 'id', 'name');
        asort($list);
        return $list;
    }

    public function getAction() {
        return $this->hasOne(Action::className(), ['id' => 'action_id'], function ($query) {
                    $query->andWhere(['is', 'action.is_delete', null]);
                });
    }

    public function getPolicy() {
        return $this->hasOne(Policy::className(), ['id' => 'policy_id'], function ($query) {
                    $query->andWhere(['is', 'policy.is_delete', null]);
                });
    }

}
