<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmToolsController extends AbstractController
{
    /**
     * @Route("/farm/tools", name="farm_tools")
     */
    public function index(): Response
    {
        return $this->render('farm_tools/index.html.twig', [
            'controller_name' => 'FarmToolsController',
        ]);
    }
}
