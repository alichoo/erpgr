<?php

namespace App\Controller;

use App\Entity\Ordm;
use App\Form\OrdmType;
 
use App\Repository\OrdmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\PHPWordService;
use App\Entity\Fgrh;

#[Route('/ordm')]
class OrdmController extends AbstractController
{
    private $phpWordService;

    public function __construct(PHPWordService $phpWordService)
    {
        $this->phpWordService = $phpWordService;
    }
    #[Route('/', name: 'app_ordm_index', methods: ['GET'])]
    public function index(OrdmRepository $ordmRepository): Response
    {
        return $this->render('ordm/index.html.twig', [
            'ordms' => $ordmRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ordm_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager ): Response
    {
        $ordm = new Ordm();
        $form = $this->createForm(OrdmType::class, $ordm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $entityManager->persist($ordm);
            $entityManager->flush();
           
          $ordmfi= $entityManager->getRepository(Fgrh::class)->findOneBy(['cat'=>'11']);
          if($ordmfi){
            $doc=$this->getParameter('uploads_directory') . '/' .$ordmfi->getFile(); 
            $ppp= $this->phpWordService->gettemplate($doc);
            $ppp->setValue('pre',$data->getNomper());
            $ppp->setValue('foo',$data->getFonction());
            $ppp->setValue('oto',$data->getAut());
            $ppp->setValue('lie',$data->getLieu());
            $ppp->setValue('miss',$data->getMission());

            $ppp->setValue('sigl','Zarsis');

            $ppp->setValue('datesig',date("d-m-Y"));
            $ppp->saveAs($this->getParameter('uploads_directory') . '/ FRG_11_ORDM' .time().".docx");
          }
       
           
          

            return $this->redirectToRoute('app_ordm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordm/new.html.twig', [
            'ordm' => $ordm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ordm_show', methods: ['GET'])]
    public function show(Ordm $ordm): Response
    {
        return $this->render('ordm/show.html.twig', [
            'ordm' => $ordm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ordm_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ordm $ordm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrdmType::class, $ordm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ordm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordm/edit.html.twig', [
            'ordm' => $ordm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ordm_delete', methods: ['POST'])]
    public function delete(Request $request, Ordm $ordm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordm->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ordm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ordm_index', [], Response::HTTP_SEE_OTHER);
    }
}
