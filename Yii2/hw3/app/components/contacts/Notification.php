<?php


namespace app\components\contacts;


interface Notification
{
    public function sendNotification(array $activities);
}