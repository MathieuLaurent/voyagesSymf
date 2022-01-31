<?php

namespace App\Controller;

use App\Repository\TagsRepository;
use App\Repository\VoyageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(VoyageRepository $voyages, TagsRepository $tags): Response
    {

        return $this->render('pages/accueil.html.twig', [
            'voyages' => $voyages->findAll(),
            'tags'=> $tags->findAll(),
        ]);
    }

    #[Route('/tagSearch', name: 'tagSearch', methods:['GET'])]
    public function tagSearch(TagsRepository $tags, Request $request) :Response
    {

        $var = $request->query->all();
        $var = $var['tags']['name'];

        return $this->render('pages/tag/tagSearch.html.twig', [
            'tag' => $var,
            'tags' => $tags->findByNameField($var),
        ]);
    }
}
