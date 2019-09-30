<?php


namespace app\components;


use app\components\contacts\LoggerNotification;

class LoggerConsole implements LoggerNotification
{

    public function log($txt)
    {
        echo $txt;
    }
}