<?php


namespace app\controllers;


use app\models\Activity;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public function behaviors()
    {
        $beha=parent::behaviors();
        $beha['authenticator']=[
            'class'=>HttpBearerAuth::class,
        ];
        return $beha;
    }


    public $modelClass=Activity::class;
}