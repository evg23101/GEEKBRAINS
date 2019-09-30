<?php


namespace app\components;


use app\base\BaseComponent;
use yii\base\Component;
use yii\caching\DbDependency;
use yii\caching\TagDependency;
use yii\db\Connection;
use yii\db\Query;

class DaoComponent extends BaseComponent
{
    public function getDB(): Connection
    {
        return \Yii::$app->db;
    }

    public function getUsers()
    {
        $sql = 'select * from users;';
        return $this->getDb()->createCommand($sql)->cache(7)->queryAll();
    }

    public function getActivityUser($user_id)
    {
        $sql = 'select * from activity where user_id=:user';
        return $this->getDb()->createCommand($sql, [':user' => $user_id])
            ->cache(10,new DbDependency(['sql' => 'select max(id) from activity where user_id='.(int)$user_id]))
            ->queryAll();
    }

    public function getActivityAny()
    {
        $query = new Query();
        $data = $query->from('activity')
            ->select(['id', 'title'])
            ->andWhere(['user_id' => 2])
            ->orderBy(['startDay' => SORT_DESC])
            ->limit(2)
            ->createCommand()->queryOne();
        return $data;
    }

    public function getReaderActivity(){
        $query = new Query();
        $data = $query->from('activity')
            ->createCommand()->query();
        return $data;
    }

    public function getCountActivity()
    {
//        TagDependency::invalidate(\Yii::$app->cache,'active');
        $query = new Query();
        $data = $query->from('activity')
            ->select('count(id) as cnt')
            ->cache(10, new TagDependency(['tags' => 'active']))
            ->scalar($this->getDb());
        return $data;
    }

    public function inserts(){
//        $this->getDb()->transaction(function(){
//            $this->getDb()->createCommand()
//                ->update('users',['email'=>'emai@email.ru'],['id'=>1])
//                ->execute();
//        });
        $trans=$this->getDb()->beginTransaction();
        try{
            $this->getDb()->createCommand()
                ->update('users',['email'=>'emai@email.ru'],['id'=>1])
                ->execute();
            throw new \Exception('err');
            $this->getDb()->createCommand()
                ->update('users',['email'=>'email@email.ru'],['id'=>2])
                ->execute();
            $trans->commit();
        }catch (\Exception $e){
            $trans->rollBack();
        }
    }
}