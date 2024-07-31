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
            // Check if the mobile number already exists
            $existingUser = User::findOne(['mobile' => $model->mobile]);

            if ($existingUser) {
                // If mobile number exists, return an error response
                return json_encode(['success' => false, 'errors' => ['mobile' => ['Mobile "' . $model->mobile . '" has already been taken.']]]);
            }

            // Save the model if no duplicate is found
            if ($model->save()) {
                return json_encode(['success' => true, 'id' => $model->id]);
            } else {
                return json_encode(['success' => false, 'errors' => $model->errors]);
            }
        }

        return json_encode(['success' => false, 'errors' => 'Failed to load data.']);
    }
}
