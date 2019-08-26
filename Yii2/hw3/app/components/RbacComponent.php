<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;
use app\rules\ViewEditOwnerActivityRule;
use yii\rbac\ManagerInterface;

class RbacComponent extends BaseComponent
{
    /** @return ManagerInterface */

    public function getManager()
    {
        return \Yii::$app->authManager;
    }

    public function initRbacRules()
    {
        $manager=$this->getManager();
        $manager->removeAll();

        $admin=$manager->createRole('admin');
        $user=$manager->createRole('user');

        $manager->add($admin);
        $manager->add($user);

        $createActivity = $manager->createPermission('createActivity');
        $createActivity->description = 'Создание активностей';
        $manager->add($createActivity);

        $viewEditOwnerActivity = $manager->createPermission('viewEditOwnerActivity');
        $viewEditOwnerActivity->description = 'Просмотр и редактирование своего события';

        $rule=new ViewEditOwnerActivityRule();
        $viewEditOwnerActivity->ruleName=$rule->name;
        $manager->add($rule);

        $manager->add($viewEditOwnerActivity);

        $viewEditAll = $manager->createPermission('viewEditAll');
        $viewEditAll->description = 'Просмотр и редактирование любых событий';
        $manager->add($viewEditAll);

        $manager->addChild($user,$createActivity);
        $manager->addChild($user,$viewEditOwnerActivity);
        $manager->addChild($admin,$user);
        $manager->addChild($admin,$viewEditAll);

        $manager->assign($admin, 3);
        $manager->assign($user, 4);
        $manager->assign($user,1);
    }

    public function canCreateActivity(): bool
    {
        return \Yii::$app->user->can('createActivity');
    }

    public function canViewEditActivity(Activity $activity)
    {
        if (\Yii::$app->user->can('viewEditAll')){
            return true;
        }

        if (\Yii::$app->user->can('viewEditOwnerActivity',['activity'=>$activity])){
            return true;
        }

        else false;
    }
}