<?php

namespace App\Controller;

use App\Entity\VoitureLocation;
use App\Form\VoitureLocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twilio\Rest\Client;


#[Route('/voiture/location')]
class VoitureLocationController extends AbstractController
{
    #[Route('/', name: 'app_voiture_location_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $voitureLocations = $entityManager
            ->getRepository(VoitureLocation::class)
            ->findAll();



        return $this->render('voiture_location/index.html.twig', [
            'voiture_locations' => $voitureLocations,
        ]);
    }

    #[Route('/new', name: 'app_voiture_location_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $voitureLocation = new VoitureLocation();
    $form = $this->createForm(VoitureLocationType::class, $voitureLocation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Check if the image_voiture field has a value
        $imageFile = $form->get('imageVoiture')->getData();
        if ($imageFile) {
            $binaryData = file_get_contents($imageFile);

            $voitureLocation->setImageVoiture($binaryData);
        }

        $entityManager->persist($voitureLocation);
        $entityManager->flush();

        
        // Redirect the user to the index page
        return $this->redirectToRoute('app_voiture_location_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('voiture_location/new.html.twig', [
        'voiture_location' => $voitureLocation,
        'form' => $form,
    ]);
}

    #[Route('/{idVoiture}', name: 'app_voiture_location_show', methods: ['GET'])]
    public function show(VoitureLocation $voitureLocation): Response
    {
        return $this->render('voiture_location/show.html.twig', [
            'voiture_location' => $voitureLocation,
        ]);
    }

    #[Route('/{idVoiture}/edit', name: 'app_voiture_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VoitureLocation $voitureLocation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoitureLocationType::class, $voitureLocation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Check if the image_voiture field has a value
            $imageVoitureFile = $form->get('imageVoiture')->getData();
            if ($imageVoitureFile) {
                $binaryData = file_get_contents($imageVoitureFile);
    
                $voitureLocation->setImageVoiture($binaryData);
            }
    
            $entityManager->flush();
    
            return $this->redirectToRoute('app_voiture_location_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('voiture_location/edit.html.twig', [
            'voiture_location' => $voitureLocation,
            'form' => $form,
        ]);
    }

    #[Route('/{idVoiture}', name: 'app_voiture_location_delete', methods: ['POST'])]
    public function delete(Request $request, VoitureLocation $voitureLocation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voitureLocation->getIdVoiture(), $request->request->get('_token'))) {
            $entityManager->remove($voitureLocation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voiture_location_index', [], Response::HTTP_SEE_OTHER);
    }
    

}
