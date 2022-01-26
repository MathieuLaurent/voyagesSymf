<?php

namespace App\Controller;

use App\Repository\VoyageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VoyageController extends AbstractController
{
    #[Route('/voyage', name: 'voyage')]
    public function index(VoyageRepository $voyage): Response
    {
        return $this->render('pages/voyage/listVoyage.html.twig', [
            'voyages' => $voyage->findAll(),
        ]);
    }
}
