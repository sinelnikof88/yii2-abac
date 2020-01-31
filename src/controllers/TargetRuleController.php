<?php

namespace sinelnikof88\abac\controllers;

use Yii;
use sinelnikof88\abac\models\TargetRule;
use sinelnikof88\abac\models\TargetRuleSearch;
use sinelnikof88\abac\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TargetRuleController implements the CRUD actions for TargetRule model.
 */
// class TargetRuleController extends Controller
class TargetRuleController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TargetRule models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TargetRuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TargetRule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TargetRule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TargetRule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing TargetRule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TargetRule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(\yii\helpers\Url::previous());
    }

    /**
     * Finds the TargetRule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TargetRule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TargetRule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAllRules($id) {
        $model = $this->findModel($id);

        $allTargets = \yii\helpers\ArrayHelper::getColumn(TargetRule::find()->asArray()->where(['target_id' => $model->target])->all(), 'policy_id');

        $poli = \yii\helpers\ArrayHelper::getColumn(\sinelnikof88\abac\models\PolicyRule::findAll(['policy_id' => $allTargets]), 'rule_id');
        $poli = \yii\helpers\ArrayHelper::getColumn(\sinelnikof88\abac\models\PolicyRule::findAll(['rule_id' => array_unique($poli)]), 'policy_id');
        $poli = \yii\helpers\ArrayHelper::getColumn(\sinelnikof88\abac\models\PolicyRule::findAll(['policy_id' => array_unique($poli)]), 'rule_id');
        $poli = \sinelnikof88\abac\models\Rule::find()->where(['id' => array_unique($poli)])->all();
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $poli]);
        return $this->renderAjax('all-rules', ['dataProvider' => $dataProvider]);
    }
    protected function get($param) {
        
    }

}
