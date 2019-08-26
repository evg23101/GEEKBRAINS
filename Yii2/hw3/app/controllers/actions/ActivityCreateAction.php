<?php


namespace app\controllers\actions;


use app\models\Activity;
use yii\base\Action;
use yii\bootstrap\ActiveForm;
use yii\web\HttpException;
use yii\web\Response;

class ActivityCreateAction extends Action
{
    public function run()
    {
        if(!\Yii::$app->rbac->canCreateActivity()){
            throw new HttpException(403,'Not Auth method');
        }

//        \Yii::$app->user->getIdentity();
        $model = \Yii::$app->activity->getModel();
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            if (\Yii::$app->activity->createActivity($model)) {
                return $this->controller->redirect(['/activity/view','id'=>$model->id]);
            } else {
                print_r($model->errors);
                exit();
            }
        }
        return $this->controller->render( 'create',['model'=>$model]);
    }
}