<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QrCodeGeneratorControllerPhpController extends AbstractController
{
    #[Route('/qr/code/generator/controller/php', name: 'app_qr_code_generator_controller_php')]
    public function index(): Response
    {
        return $this->render('qr_code_generator_controller_php/index.html.twig', [
            'controller_name' => 'QrCodeGeneratorControllerPhpController',
        ]);
    }
}
