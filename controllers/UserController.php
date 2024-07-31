<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class UserController extends Controller
{
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax && !Yii::$app->request->isPjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if ($model->save()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => true, 'id' => $model->id];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false, 'errors' => $model->errors];
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
