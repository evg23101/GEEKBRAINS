<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Users;
use yii\base\Component;

class AuthComponent extends BaseComponent
{
    public function signin(Users &$model):bool
    {
        $model->scenarioSignin();
        if (!$model->validate(['email','password'])) {
            return false;
        }

        $user=$this->getUserByEmail($model->email);
        if(!$this->validationPassword($model->password,$user->password_hash))
        {
            $model->addError('password','Неверный пароль');
            return false;
        }

        return \Yii::$app->user->login($user,3600);
    }

    private function validationPassword($password, $password_hash):bool
    {
        return \Yii::$app->security->validatePassword($password, $password_hash);
    }

    private function getUserByEmail(string $email):?Users
    {
        return Users::find()->andWhere(['email'=>$email])->one();
    }

    public function signup(Users &$user):bool
    {
        $user->scenarioSignup();
        if (!$user->validate(['email','password'])) {
            return false;
        }

        $user->password_hash=$this->genHashPassword($user->password);

        if (!$user->save()){
            return false;
        }

        return true;
    }

    private function genHashPassword($password):string
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }
}