<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;
use app\models\Activity;
use yii\web\Controller;
use yii\web\HttpException;

class ActivityController extends BaseController
{
  public function actions()
  {
      return [
          'create' => ['class'=>ActivityCreateAction::class]
      ];
  }

    public function actionView($id)
    {
        $model=Activity::find()->andWhere(['id'=>$id])->one();
        if (!\Yii::$app->rbac->canViewEditActivity($model)){
            throw new HttpException(403,'BOOOOOOOOOO');
        }
        return $this->render('view',['model'=>$model]);
    }
}