<?php

namespace sinelnikof88\abac\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "action".
 *
 * @property int $id
 * @property string $name
 * @property string $class
 * @property string $date_create
 * @property string $date_update
 * @property int $is_active
 * @property int $is_delete
 */
class Action extends \yii\db\ActiveRecord {

    public static function find() {
        return new ActiveQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'action';
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
            [['date_create', 'date_update'], 'safe'],
            [['is_active', 'is_delete'], 'integer'],
            [['name', 'class'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'class' => 'Class',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'is_active' => 'Is Active',
            'is_delete' => 'Is Delete',
        ];
    }

    public function getClassList() {

        $setting = SettingsForm::getConfig();

        $path = $setting->action_directory;
        $namespase = $setting->action_namespace;

        $list = \sinelnikof88\abac\components\Scaner::classList($path, $namespase);
        $databaseList = Action::find()->select(['class'])->column();
        $diffRules = array_diff($list, $databaseList);

        $resultArray = [];
        foreach ($diffRules as $diffRule) {
            $resultArray[$diffRule] = $diffRule;
        }
        if (empty($diffRules) && $this->class) {
            $resultArray[$this->class] = $this->class;
        }
        return $resultArray;
    }

    public function getCode() {
        if (!class_exists($this->class)) {
            return '!!Внимание клас не реализованн!!';
        }
        $func = new \ReflectionMethod($this->class, 'check');

        $f = $func->getFileName();
        $start_line = $func->getStartLine() - 1;
        $end_line = $func->getEndLine();
        $length = $end_line - $start_line;

        $source = file($f);
        $source = implode('', array_slice($source, 0, count($source)));
        // $source = preg_split("/(\n|\r\n|\r)/", $source);
        $source = preg_split("/" . PHP_EOL . "/", $source);

        $body = '';
        for ($i = $start_line; $i < $end_line; $i++)
            $body .= "{$source[$i]}\n";

        return '<pre>' . $body . '</pre>';
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
