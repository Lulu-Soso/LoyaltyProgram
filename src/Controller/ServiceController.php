<?php

namespace App\Controller;

use App\Model\serviceManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{



    public function show(): string
    {

        return $this->twig->render('service/show.html.twig');
    }
}
