<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\VoitureLocation;
use Knp\Component\Pager\PaginatorInterface;
use Twilio\Rest\Client;



#[Route('/location')]
class LocationController extends AbstractController
{
 




    #[Route('/', name: 'app_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $voitureLocations = $entityManager
            ->getRepository(VoitureLocation::class)
            ->findAll();

        $pagination = $paginator->paginate(
            $voitureLocations,
            $request->query->getInt('page', 1),
            3
        );
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Extract the selected VoitureLocation entity from the form
            $selectedVoitureLocation = $form->get('voitureLocation')->getData();

            // Set the id_voiture, modele, and matricule fields of the Location entity
            $voiture = $location->getVoitureLocation();
            $idVoiture = $voiture->getIdVoiture();
            $modele = $voiture->getModele();
            $matricule = $voiture->getMatricule();
            $imageVoiture = $voiture->getImageVoiture();

            $location->setIdVoiture($idVoiture);
            $location->setModele($modele);
            $location->setMatricule($matricule);
            $location->setImageVoiture($imageVoiture);
            $location->setPrixLocation($voiture->getPrixJour() * abs($location->getDateDebut()->diff($location->getDateFin())->days));



            $entityManager->persist($location);
            $entityManager->flush();

            // Send an SMS notification using Twilio
            $twilioClient = new Client($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);
            $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
            $recipientPhoneNumber = '+21653802106'; // Replace with the recipient's phone number
            $message = 'Your rental car is confirmed!'; // Customize your message here
            $twilioClient->messages->create(
                $recipientPhoneNumber,
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $message,
                ]
            );

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/new.html.twig', [
            'voiture_locations' => $pagination,
            'location' => $location,
            'form' => $form,

        ]);
    }

    #[Route('/liste', name: 'app_location_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $locations = $entityManager
            ->getRepository(Location::class)
            ->findAll();

        return $this->render('location/index.html.twig', [
            'locations' => $locations,
        ]);
    }
    #[Route('/liste/{idLocation}', name: 'app_location_show', methods: ['GET'])]
    public function show(Location $location): Response
    {
        return $this->render('location/show.html.twig', [
            'location' => $location,
        ]);
    }

    #[Route('/liste/{idLocation}/edit', name: 'app_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

// Send an SMS notification using Twilio
            $twilioClient = new Client($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);
            $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
            $recipientPhoneNumber = '+21653802106'; // Replace with the recipient's phone number
            $message = 'Rental modified successfuly!'; // Customize your message here
            $twilioClient->messages->create(
                $recipientPhoneNumber,
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $message,
                ]
            );
            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/location/edit.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/liste/{idLocation}', name: 'app_location_delete', methods: ['POST'])]
    public function delete(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$location->getIdLocation(), $request->request->get('_token'))) {
            $entityManager->remove($location);
            $entityManager->flush();
            // Send an SMS notification using Twilio
            $twilioClient = new Client($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);
            $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
            $recipientPhoneNumber = '+21653802106'; // Replace with the recipient's phone number
            $message = 'You have canceled your reservation!'; // Customize your message here
            $twilioClient->messages->create(
                $recipientPhoneNumber,
                [
                    'from' => $twilioPhoneNumber,
                    'body' => $message,
                ]
            );
        }

        return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
    }

}
