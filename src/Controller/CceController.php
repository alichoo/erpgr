<?php

namespace App\Controller;

use App\Entity\Cce;
use App\Entity\Fgrh;
use App\Form\CceType;
use App\Repository\CceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\PHPWordService;

#[Route('/cce')]
class CceController extends AbstractController
{

    private $phpWordService;

    public function __construct(PHPWordService $phpWordService)
    {
        $this->phpWordService = $phpWordService;
    }
    #[Route('/', name: 'app_cce_index', methods: ['GET'])]
    public function index(CceRepository $cceRepository): Response
    {
        return $this->render('cce/index.html.twig', [
            'cces' => $cceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cce = new Cce();
        $form = $this->createForm(CceType::class, $cce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
           
           
          $ordmfi= $entityManager->getRepository(Fgrh::class)->findOneBy(['cat'=>'19']);
          if($ordmfi){
            $doc=$this->getParameter('uploads_directory') . '/' .$ordmfi->getFile(); 
            $ppp= $this->phpWordService->gettemplate($doc);
            $ppp->setValue('nomp',$data->getNomp());
            $ppp->setValue('date',date("d-m-Y"));
            $output='FRG_19_CCE' .time().".docx";
            $ppp->saveAs( $this->getParameter('uploads_directory') . '/'.$output); 
            $cce->setFile( $output);
            $entityManager->persist($cce);
            $entityManager->flush();
            return $this->redirectToRoute('ordm_download', ['filename' => $output]);

          }

            return $this->redirectToRoute('app_cce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cce/new.html.twig', [
            'cce' => $cce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cce_show', methods: ['GET'])]
    public function show(Cce $cce): Response
    {
        return $this->render('cce/show.html.twig', [
            'cce' => $cce,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cce $cce, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CceType::class, $cce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cce/edit.html.twig', [
            'cce' => $cce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cce_delete', methods: ['POST'])]
    public function delete(Request $request, Cce $cce, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cce->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cce_index', [], Response::HTTP_SEE_OTHER);
    }
}
