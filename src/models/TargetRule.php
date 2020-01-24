<?php

namespace sinelnikof88\abac\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "target_rule".
 *
 * @property int $id
 * @property int $target_id
 * @property int $policy_id
 * @property string $date_create
 * @property string $date_update
 * @property int $is_delete
 */
class TargetRule extends \yii\db\ActiveRecord {

    public static function find() {
        return new ActiveQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'target_rule';
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
            [['target_id', 'policy_id', 'is_delete'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'target_id' => 'Target ID',
            'policy_id' => 'Policy ID',
            'date_create' => 'Date Create',
            'date_update' => 'Update On',
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

    public function getTargetList() {
        $setting = SettingsForm::getConfig();
        $targetClass = $setting->target;
        $models = $targetClass::find()->all();
        $list = \common\components\ArrayHelper::map($models, 'id', 'name');
        asort($list);
        return $list;
    }

    public function getRuleList() {
        $models = Rule::find()->all();
        $list = \common\components\ArrayHelper::map($models, 'id', 'name');
        asort($list);
        return $list;
    }

    public function getPolicy() {
        return $this->hasOne(Policy::className(), ['id' => 'policy_id']);
    }

    public function getTarget() {
        $setting = SettingsForm::getConfig();
        $targetClass = $setting->target;

        $pk = $setting->target::primaryKey();
        return $this->hasOne($targetClass::className(), [current($pk) => 'target_id']);
    }

}
