<?php 

namespace App\Controller;

use App\Form\TagsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuTagSearchController extends AbstractController
{

    public function renderTagSearch(Request $request): Response
    {

        $formTag = $this->createForm(TagsType::class);
        $formTag->handleRequest($request);

        if($formTag->isSubmitted() && $formTag->isValid()){
            return $this->redirectToRoute('tagSearch', [
                'tag' => $formTag->getData('name')->getName(),
            ]);
        }

        return $this->render('inc/header.html.twig', [
            'formTag' => $formTag->createView(),
        ]);
    }
}
