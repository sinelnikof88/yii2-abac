<?php

namespace sinelnikof88\abac\controllers;

use Yii;
use sinelnikof88\abac\models\Rule;
use sinelnikof88\abac\models\RuleSearch;
use sinelnikof88\abac\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Description of Settings
 *
 * @author Gonnyh.I
 */
class SettingController extends Controller {

    public function actionIndex() {
        $model = \sinelnikof88\abac\models\SettingsForm::getConfig();
        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->request->isPjax) {
                if ($model->save()) {
                    return true;
//                    return $this->redirect(['request/view', 'id' => $model->request->ID]);
                }
            }
        }
        return $this->render('index', ['model' => $model]);
    }

}
