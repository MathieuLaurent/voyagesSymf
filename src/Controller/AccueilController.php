<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\TagsType;
use App\Form\VoyageType;
use App\Repository\TagsRepository;
use Doctrine\DBAL\Types\TextType;
use App\Repository\VoyageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(VoyageRepository $voyages, Request $request): Response
    {
        $form = $this->createForm(TagsType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            return $this->redirectToRoute('tagSearch', [
                'tag' => $form->getData('name')->getName()
            ]);
        }


        return $this->render('pages/accueil.html.twig', [
            'voyages' => $voyages->findAll(),
            'form' => $form->createView()
        ]);
    }

    #[Route('/tagSearch/{tag}', name: 'tagSearch')]
    public function tagSearch(string $tag, VoyageRepository $voyages, Request $request, TagsRepository $tags) :Response
    {
        $form = $this->createForm(TagsType::class);
        $form->handleRequest($request);


        return $this->render('pages/tag/tagSearch.html.twig', [
            'form' => $form->createView(),
            'tags' => $tag,
            'voyages' => $voyages->findAll(),
        ]);
    }
}
