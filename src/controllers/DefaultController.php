<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\controllers;

use Yii;
use sinelnikof88\abac\models\Action;
use sinelnikof88\abac\models\ActionSearch;
use sinelnikof88\abac\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Description of DefaultController
 *
 * @author Gonnyh.I
 */
class DefaultController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

  
    public function actionCheckDatabase() {
        $this->renderAjax('check-database');
    }

    public function actionStand() {
        $model = \sinelnikof88\abac\models\StandForm::instance();
        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->request->isPjax) {
                if ($model->execute()) {
                    //                    return $this->redirect(['request/view', 'id' => $model->request->ID]);
                }
            }
        }
        return $this->render('stand', ['model'=>$model]);
    }

}
