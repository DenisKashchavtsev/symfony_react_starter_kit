<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpaController extends AbstractController
{
    #[Route('/{route}',
        name: 'app_spa',
        requirements: ['route"' => '"^(?!api).+'],
        defaults: ['route' => null])]
    public function index(): Response
    {
        return $this->render('spa/index.html.twig');
    }
}
