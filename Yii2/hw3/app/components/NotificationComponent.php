<?php


namespace app\components;


use app\components\contacts\LoggerNotification;
use app\components\contacts\Notification;
use yii\base\Component;
use yii\console\Application;
use yii\mail\MailerInterface;

class NotificationComponent implements Notification
{
    /** @var MailerInterface */
    private $mailer;
    private $logger;

    public function __construct(MailerInterface $mailer, LoggerNotification $logger)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    /** param $activities Activity[] */
    public function sendNotification(array $activities)
    {
        foreach ($activities as $activity) {
            if ($this->mailer->compose('notif',['model'=>$activity])
                ->setFrom('galkineo@yadex.ru')
                ->setSubject('Событие стартует сегодня')
                ->setTo($activity->email)
                ->send())
                {
                    $this->logger->log('Success for mail '.$activity->email.PHP_EOL);

                } else {

                    $this->logger->log('Error for mail '.$activity->email.PHP_EOL);
            }
        }
    }
}