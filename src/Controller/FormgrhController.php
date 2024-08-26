<?php

namespace App\Controller;

use App\Entity\Formgrh;
use App\Form\FormgrhType;
use App\Repository\FormgrhRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
 
use PhpOffice\PhpWord\IOFactory;
use App\Service\PHPWordService;

#[Route('/frm')]
class FormgrhController extends AbstractController
{
    private $phpWordService;

    public function __construct(PHPWordService $phpWordService)
    {
        $this->phpWordService = $phpWordService;
    }
    

    #[Route('/getww', name: 'app_generate_word', methods: ['GET'])]
    public function generateWord(): Response
    {
        // Create a new PhpWord object
        $phpWord = $this->phpWordService->createPHPWord();
        $doc='resources/presens.docx';
        $ppp= $this->phpWordService->gettemplate($doc);
        // Add a new section
        $section = $phpWord->addSection();
        $ppp->setValue('statt', 'ok'); 
        
        $filenam='resources/Sample_07_TemplateCloneRow.docx';
        $ppp->saveAs($filenam);
        $filenam='resources/Sample_07_TemplateCloneRow.docx';
        $ppp->saveAs($filenam);
        // Create a writer to save the document
        $writer = IOFactory::createWriter($phpWord, 'Word2007');

        // Stream the document to the browser
        $response = new Response();
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $response->headers->set('Content-Disposition', 'attachment;filename="hello-world.docx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        // Capture the output
        ob_start();
        $writer->save('php://output');
        $response->setContent(ob_get_clean());

        return $response;
    }
    

    #[Route('/', name: 'app_formgrh_index', methods: ['GET'])]
    public function index(FormgrhRepository $formgrhRepository): Response
    {
        return $this->render('formgrh/index.html.twig', [
            'formgrhs' => $formgrhRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formgrh_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formgrh = new Formgrh();
        $form = $this->createForm(FormgrhType::class, $formgrh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formgrh);
            $entityManager->flush();

            return $this->redirectToRoute('app_formgrh_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formgrh/new.html.twig', [
            'formgrh' => $formgrh,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formgrh_show', methods: ['GET'])]
    public function show(Formgrh $formgrh): Response
    {
        return $this->render('formgrh/show.html.twig', [
            'formgrh' => $formgrh,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formgrh_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formgrh $formgrh, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormgrhType::class, $formgrh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formgrh_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('formgrh/edit.html.twig', [
            'formgrh' => $formgrh,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formgrh_delete', methods: ['POST'])]
    public function delete(Request $request, Formgrh $formgrh, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formgrh->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($formgrh);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formgrh_index', [], Response::HTTP_SEE_OTHER);
    }
}
