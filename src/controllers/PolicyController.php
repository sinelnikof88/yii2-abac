<?php

namespace sinelnikof88\abac\controllers;

use Yii;
use sinelnikof88\abac\models\Policy;
use sinelnikof88\abac\models\PolicySearch;
use sinelnikof88\abac\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PolicyController implements the CRUD actions for Policy model.
 */
// class PolicyController extends Controller
class PolicyController extends Controller {

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
     * Lists all Policy models.
     * @return mixed
     */
    public function actionIndex() {
        \yii\helpers\Url::remember();

        $searchModel = new PolicySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Policy model.
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
     * Creates a new Policy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Policy();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Policy model.
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
     * Deletes an existing Policy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Policy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Policy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Policy::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddRule($id) {
        $model = new \sinelnikof88\abac\models\PolicyRule();
        $model->policy_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(\yii\helpers\Url::previous());
        }
        return $this->renderAjax('add-rule', ['model' => $model]);
    }
    public function actionAddAction($id) {
        $model = new \sinelnikof88\abac\models\PolicyAction();
        $model->policy_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(\yii\helpers\Url::previous());
        }
        return $this->renderAjax('add-action', ['model' => $model]);
    }

    public function actionAddTarget($id) {
        $model = new \sinelnikof88\abac\models\TargetRule();
        $model->policy_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(\yii\helpers\Url::previous());
        }
        return $this->renderAjax('add-target', ['model' => $model]);
    }

}
