<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    // Route for home page
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
