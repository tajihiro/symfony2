<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ScheduleController extends Controller
{
    /**
     * @Route("/schedule")
     */
    public function indexAction()
    {
        $scheduleList = [
            [
                "date" => "2020年11月1日",
                "time" => "12:00",
                "place" => "群馬",
            ],
            [
                "date" => "2020年11月2日",
                "time" => "13:30",
                "place" => "横浜",
            ],
            [
                "date" => "2020年11月3日",
                "time" => "18:00",
                "place" => "東京",
            ],
        ];
        return $this->render('AppBundle:Scedule:index.html.twig',
            ['scheduleList' => $scheduleList]
        );
    }

}
