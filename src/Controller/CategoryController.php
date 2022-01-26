<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function index(CategoryRepository $category): Response
    {
        return $this->render('pages/category/listCategory.html.twig', [
            'categorys' => $category->findAll(),
        ]);
    }

    #[Route('/category/{id}', name: 'detailCategory')]
    public function detailCategory(CategoryRepository $category, int $id): Response
    {
        return $this->render('pages/category/detailCategory.html.twig', [
            'categorys' => $category->find($id),
        ]);
    }
}
