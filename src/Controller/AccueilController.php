<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageType;
use Doctrine\DBAL\Types\TextType;
use App\Repository\VoyageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(VoyageRepository $voyages): Response
    {
        $form = $this->createForm(VoyageType::class);
        $form->handleRequest();


        return $this->render('pages/accueil.html.twig', [
            'voyages' => $voyages->findAll(),
        ]);
    }
}
