<?php
namespace HeticBundle\Services;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Created by PhpStorm.
 * User: Hadrien
 * Date: 27/01/2017
 * Time: 17:23
 */
class TimeIsOnMySide
{

    public function getAge(\DateTime $datetime)
    {
        $now = new \DateTime('now');
        if ($datetime > $now)
        {

            return null;
        }

        $interval = $datetime->diff($now);

        return $interval->y;
    }
}