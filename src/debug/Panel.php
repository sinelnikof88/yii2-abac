<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\debug;

use Yii;
use yii\base\NotSupportedException;
use yii\base\ViewContextInterface;
use yii\helpers\VarDumper;
use yii\queue\JobInterface;
use yii\queue\PushEvent;
use yii\queue\Queue;

/**
 * Description of Panel
 *
 * @author Gonnyh.I
 */
class Panel extends \yii\debug\Panel implements ViewContextInterface {

    private $_jobs = [];
    private $_rulesArrt = [];
    private $_policy = [];
    private $_rule = [];

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'ABAC';
    }

    protected function getCode($class) {
        if (!class_exists($class)) {
            return '!!Внимание клас не реализованн!!';
        }

        $func = new \ReflectionMethod($class, 'pre');

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

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if (\Yii::$app->user->identity) {
            $this->_rulesArrt = \Yii::$app->user->identity->filtredAttributes;
            if (!empty($this->_rulesArrt)) {

                $policyCollection = \sinelnikof88\abac\components\PolicyCollection::instance();
                $this->_policy = $policyCollection->all();
            }
        }
    }

    /**
     * @param PushEvent $event
     * @return array
     */
    protected function getPushData(PushEvent $event) {
        $data = [];
        foreach (Yii::$app->getComponents(false) as $id => $component) {
            if ($component === $event->sender) {
                $data['sender'] = $id;
                break;
            }
        }
        $data['id'] = $event->id;
        $data['ttr'] = $event->ttr;
        $data['delay'] = $event->delay;
        $data['priority'] = $event->priority;
        if ($event->job instanceof JobInterface) {
            $data['class'] = get_class($event->job);
            $data['properties'] = [];
            foreach (get_object_vars($event->job) as $property => $value) {
                $data['properties'][$property] = VarDumper::dumpAsString($value);
            }
        } else {
            $data['data'] = VarDumper::dumpAsString($event->job);
        }

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function save() {
        return ['jobs' => $this->_jobs];
    }

    /**
     * @inheritdoc
     */
    public function getViewPath() {
        return __DIR__ . '/views';
    }

    /**
     * @inheritdoc
     */
    public function getSummary() {
        return Yii::$app->view->render('summary', [
                    'url' => $this->getUrl(),
                    'count' => isset($this->data['jobs']) ? count($this->data['jobs']) : 0,
                    'countAttr' => isset($this->_rulesArrt) ? count($this->_rulesArrt) : 0,
                    'countPolicy' => isset($this->_policy) ? count($this->_policy) : 0,
                        ], $this);
    }

    /**
     * @inheritdoc
     */
    public function getDetail() {

        $data = [];
        foreach ($this->_policy as $policy) {
            $data [] = $this->getCode(get_class($policy));
        }
        $data = array_unique($data);

        return Yii::$app->view->render('detail', ['data' => $data], $this);
    }

}
