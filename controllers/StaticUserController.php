<?php
namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;

class StaticUserController extends Controller
{
    public function actionInsertStaticUser()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            $existingUser = User::findOne(['mobile' => $model->mobile]);

            if ($existingUser) {

                return json_encode(['success' => false, 'errors' => ['mobile' => ['Mobile "' . $model->mobile . '" has already been taken.']]]);
            }

            if ($model->save()) {
                return json_encode(['success' => true, 'id' => $model->id]);
            } else {
                return json_encode(['success' => false, 'errors' => $model->errors]);
            }
        }

        return json_encode(['success' => false, 'errors' => 'Failed to load data.']);
    }
}
