<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Gedmo\Sluggable\Util\Urlizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user')]
    public function index(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {

        $formUser= $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);

        if($formUser->isSubmitted() && $formUser->isValid()){
            
            $uploadedFile = $formUser['picture']->getData();
            
            if($uploadedFile){
                $destination = $this->getParameter('kernel.project_dir').'/public/img';
                
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move($destination, $newFilename);
                $user->setPicture($newFilename);
            }


            $entityManager->persist($user);
            $entityManager->flush();

        }


        return $this->render('pages/user/profil.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }
}
