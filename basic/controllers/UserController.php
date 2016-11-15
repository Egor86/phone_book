<?php

namespace app\controllers;

use Yii;
use app\models\PhoneBook;
use app\models\PhoneBookSearch;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * UsersController implements the CRUD actions for PhoneBook model.
 */
class UserController extends Controller
{
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] =
            ['application/htm;' => Response::FORMAT_HTML];

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'index' =>['get'],
            'view' => ['get'],
            'create' => ['get', 'post'],
            'update' => ['get', 'put'],
            'delete' => ['delete']
        ];
    }
    /**
     * Lists all PhoneBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhoneBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * @param $name
     * @return string
     */
    public function actionView($name)
    {
        $model = $this->findModelByName($name);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new PhoneBook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhoneBook();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'name' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PhoneBook model.
     * If update is successful, send new 'view' URL and AJAX will redirect.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPut) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $response['success'] = false;
            if ($model->load(Yii::$app->request->getBodyParams()) && $model->save()) {
                $response['success'] = true;
                $response['location'] = Url::to(['user/view', 'name' => $model->name]);
                return $response;
            }
            $response['error'] = $model->getFirstErrors();
            return $response;
        }
        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing PhoneBook model.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->findModel($id)->delete();
    }

    /**
     * Finds the PhoneBook model by User name.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return PhoneBook the loaded model
     * @throws NotFoundHttpException
     */
    protected function findModelByName($name)
    {
        if (($model = PhoneBook::findOne(['name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the PhoneBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PhoneBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhoneBook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
