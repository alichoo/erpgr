<?php

namespace App\Controller;

use App\Entity\Fgrh;
use App\Form\FgrhType;
use App\Repository\FgrhRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;



#[Route('/fgrh')]
class FgrhController extends AbstractController
{
    #[Route('/', name: 'app_fgrh_index', methods: ['GET'])]
    public function index(FgrhRepository $fgrhRepository): Response
    {
        return $this->render('fgrh/index.html.twig', [
            'fgrhs' => $fgrhRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fgrh_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $fgrh = new Fgrh();
        $form = $this->createForm(FgrhType::class, $fgrh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('file')->getData();
            if ($uploadedFile) {
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $fgrh->setFile($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'File upload failed: ' . $e->getMessage());
                }
            }

            $entityManager->persist($fgrh);
            $entityManager->flush();

            return $this->redirectToRoute('app_fgrh_index');
        }

        return $this->render('fgrh/new.html.twig', [
            'fgrh' => $fgrh,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_fgrh_show', methods: ['GET'])]
    public function show(Fgrh $fgrh): Response
    {
        return $this->render('fgrh/show.html.twig', [
            'fgrh' => $fgrh,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fgrh_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fgrh $fgrh, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(FgrhType::class, $fgrh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('file')->getData();
            if ($uploadedFile) {
                // Delete old file
                if ($fgrh->getFile()) {
                    unlink($this->getParameter('uploads_directory') . '/' . $fgrh->getFile());
                }

                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $fgrh->setFile($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'File upload failed: ' . $e->getMessage());
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_fgrh_index');
        }

        return $this->render('fgrh/edit.html.twig', [
            'fgrh' => $fgrh,
            'form' => $form->createView(),
        ]);
    }
        #[Route('/{id}', name: 'app_fgrh_delete', methods: ['POST'])]
    public function delete(Request $request, Fgrh $fgrh, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fgrh->getId(), $request->request->get('_token'))) {
            // Delete file from server
            if ($fgrh->getFile()) {
                unlink($this->getParameter('uploads_directory') . '/' . $fgrh->getFile());
            }

            $entityManager->remove($fgrh);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_fgrh_index');
    }
    #[Route('/fgrh/download/{id}', name: 'app_fgrh_download', methods: ['GET'])]
    public function downloadFile(EntityManagerInterface $entityManager, int $id): Response
    {
        // Fetch the Fgrh entity by its id
        $fgrh = $entityManager->getRepository(Fgrh::class)->find($id);

        // Check if the entity and file exist
        if (!$fgrh || !$fgrh->getFile()) {
            throw $this->createNotFoundException('File not found.');
        }

        // Full path to the file
        $filePath =$this->getParameter('uploads_directory') . '/' . $fgrh->getFile();

        // Check if the file exists
        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('File not found on server.');
        }

        // Return the file as a BinaryFileResponse
        $response = new BinaryFileResponse($filePath);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, basename($filePath));

        return $response;
    }
}
