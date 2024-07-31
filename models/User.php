<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['name', 'country_code', 'mobile', 'email', 'gender'], 'required'],
            ['email', 'email'],
            ['mobile', 'string', 'max' => 15],
            ['country_code', 'string', 'max' => 3],
            [['name', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            ['gender', 'in', 'range' => ['M', 'F']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'country_code' => 'Country Code',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'gender' => 'Gender',
        ];
    }
}
