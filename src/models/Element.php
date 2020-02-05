<?php

namespace sinelnikof88\abac\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "element".
 *
 * @property int $id
 * @property string $name
 * @property string $class
 */
class Element extends \yii\db\ActiveRecord {

    public static function find() {
        return new ActiveQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'element';
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
        ];
    }

    public function getCode() {
        if(!class_exists($this->class)){
            return '!!Внимание клас не реализованн!!';
        }
        $func = new \ReflectionMethod($this->class, 'accsess');

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

        //        $path = '/var/www/html/yii2/example/vendor/sinelnikof88/yii2-abac/src/components/elements';
        //        $namespase = 'sinelnikof88\abac\components\elements';

        $path = $setting->element_directory;
        $namespase = $setting->element_namespace;

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
