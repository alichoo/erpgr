<?php 

// src/Controller/RedirectController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    #[Route('/redirect/{cat}', name: 'category_redirect')]
    public function redirectToForm(string $cat): RedirectResponse
    {
        switch ($cat) {
            case 'cat1':
                return $this->redirectToRoute('form_cat1');
            case 'cat2':
                return $this->redirectToRoute('form_cat2');
            case 'cat3':
                return $this->redirectToRoute('form_cat3');
            // Add more cases for other categories
            default:
                throw $this->createNotFoundException('Category not found');
        }
    }
}
