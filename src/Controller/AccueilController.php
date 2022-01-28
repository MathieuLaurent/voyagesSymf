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

        $formTag = $this->createForm(TagsType::class);
        $formTag->handleRequest($request);
        if($formTag->isSubmitted() && $formTag->isValid()){

            return $this->redirectToRoute('tagSearch', [
                'tag' => $formTag->getData('name')->getName(),
            ]);
        }


        return $this->render('pages/accueil.html.twig', [
            'voyages' => $voyages->findAll(),
            'formTag' => $formTag->createView()
        ]);
    }

    #[Route('/tagSearch/{tag}', name: 'tagSearch')]
    public function tagSearch(string $tag, Request $request, TagsRepository $tags) :Response
    {
        $formTag = $this->createForm(TagsType::class);
        $formTag->handleRequest($request);


        return $this->render('pages/tag/tagSearch.html.twig', [
            'formTag' => $formTag->createView(),
            'tag' => $tag,
            'tags' => $tags->findByNameField($tag),
        ]);
    }
}
