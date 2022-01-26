<?php

namespace App\Controller;

use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(VoyageRepository $voyages): Response
    {
        return $this->render('pages/accueil.html.twig', [
            'voyages' => $voyages->findAll(),
        ]);
    }
}
