<?php

namespace App\Controller;

use App\Entity\VoitureLocation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api')]
class ApiLocationController extends AbstractController
{
    #[Route('/voiturelocation', name: 'voiturelocation_api', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $voitureLocations = $entityManager->getRepository(VoitureLocation::class)->findAll();

        $responseArray = array();
        foreach ($voitureLocations as $voitureLocation) {
            $responseArray[] = array(
                'id_voiture' => $voitureLocation->getIdVoiture(),
                'modele' => $voitureLocation->getModele(),
                'matricule' => $voitureLocation->getMatricule(),
                'prix_jour' => $voitureLocation->getPrixJour(),
                'carte_grise' => $voitureLocation->getCarteGrise()
                
            );
        }

        $responseData = json_encode($responseArray);
        $response = new Response($responseData);
        $response->headers->set('Content-voiturelocation', 'application/json');

        return $response;
    }

    #[Route('/voiturelocation/{idVoiture}', name: 'voiturelocation_delete', methods: ['DELETE'])]
    public function deleteVoiture(int $idVoiture, EntityManagerInterface $entityManager): JsonResponse
    {
        $voitureLocation = $entityManager->getRepository(VoitureLocation::class)->find($idVoiture);

        if (!$voitureLocation) {
            throw $this->createNotFoundException('The voiture location does not exist');
        }

        $entityManager->remove($voitureLocation);
        $entityManager->flush();

        $response = new JsonResponse(['status' => 'deleted'], Response::HTTP_OK);
        return $response;
    }
    #[Route('/voiturelocation/{idVoiture}', name: 'voiturelocation_edit', methods: ['PUT'])]
public function editVoiture(Request $request, $idVoiture, EntityManagerInterface $entityManager): JsonResponse
{
    $voitureLocation = $entityManager->getRepository(VoitureLocation::class)->find($idVoiture);

    if (!$voitureLocation) {
        return new JsonResponse(['status' => 'Failed']);
    }

    $data = json_decode($request->getContent(), true);

    if (isset($data['modele'])) {
        $voitureLocation->setModele($data['modele']);
    }

    if (isset($data['matricule'])) {
        $voitureLocation->setMatricule($data['matricule']);
    }

    if (isset($data['prix_jour'])) {
        $voitureLocation->setPrixJour($data['prix_jour']);
    }

    if (isset($data['carte_grise'])) {
        $voitureLocation->setCarteGrise($data['carte_grise']);
    }

    $entityManager->flush();

    return new JsonResponse(['status' => 'edited'], Response::HTTP_OK);
}

#[Route('/voiturelocation/add', name: 'voiturelocation_add', methods: ['GET', 'POST'])]
public function addVoiture(Request $request, EntityManagerInterface $entityManager): JsonResponse
{
    $voitureLocation = new VoitureLocation();

    $voitureLocation->setModele($request->request->get('modele'));
    $voitureLocation->setMatricule($request->request->get('matricule'));
    $voitureLocation->setPrixJour($request->request->get('prix_jour'));
    $voitureLocation->setCarteGrise($request->request->get('carte_grise'));

    $entityManager->persist($voitureLocation);
    $entityManager->flush();

    $response = new JsonResponse(['status' => 'added'], Response::HTTP_CREATED);
    return $response;
}
    
}
