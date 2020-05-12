<?php

namespace sinelnikof88\abac\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "rule".
 *
 * @property int $id
 * @property string $name
 * @property string $class
 */
class Rule extends \yii\db\ActiveRecord {

    public static function find() {
        return new ActiveQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'rule';
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
            [['name', 'class'], 'string', 'max' => 200],
            [['description'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Нзвание правила',
            'class' => 'Class',
            'description' => 'Описание правила',
        ];
    }

    public function getCode() {
        if(!class_exists($this->class)){
            return '!!Внимание клас не реализованн!!';
        }
        $func = new \ReflectionMethod($this->class, 'pre');

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

    public function getClassList() {

        $setting = SettingsForm::getConfig();

        //        $path = '/var/www/html/yii2/example/vendor/sinelnikof88/yii2-abac/src/components/rules';
        //        $namespase = 'sinelnikof88\abac\components\rules';

        $path = $setting->rule_directory;
        $namespase = $setting->rule_namespace;

        $list = \sinelnikof88\abac\components\Scaner::classList($path, $namespase);
        $databaseList = Rule::find()->select(['class'])->column();
        $diffRules = array_diff($list, $databaseList);

        $resultArray = [];
        foreach ($diffRules as $diffRule) {
            $resultArray[$diffRule] = $diffRule;
        }
        if (empty($diffRules) && $this->class) {
            $resultArray[$this->class] = $this->class;
        }
        asort($resultArray);
        return $resultArray;
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
