<?php 

// src/Controller/FormController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form/cat1', name: 'form_cat1')]
    public function formCat1(): Response
    {
        return $this->render('forms/form_cat1.html.twig');
    }

    #[Route('/form/cat2', name: 'form_cat2')]
    public function formCat2(): Response
    {
        return $this->render('forms/form_cat2.html.twig');
    }

    #[Route('/form/cat3', name: 'form_cat3')]
    public function formCat3(): Response
    {
        return $this->render('forms/form_cat3.html.twig');
    }

    // Add more routes for other categories as needed
}

?>