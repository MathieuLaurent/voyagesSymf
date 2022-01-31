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
    public function index(VoyageRepository $voyages, Request $request, TagsRepository $tags): Response
    {

        return $this->render('pages/accueil.html.twig', [
            'voyages' => $voyages->findAll(),
            'tags'=> $tags->findAll(),
        ]);
    }

    #[Route('/tagSearch/{tag}', name: 'tagSearch')]
    public function tagSearch(string $tag, Request $request, TagsRepository $tags) :Response
    {
        

        return $this->render('pages/tag/tagSearch.html.twig', [
            'tag' => $tag,
            'tags' => $tags->findByNameField($tag),
        ]);
    }
}
