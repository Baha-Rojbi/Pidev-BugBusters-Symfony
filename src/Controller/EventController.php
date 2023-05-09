<?php

namespace App\Controller;
use App\Entity\Event;

use App\Form\EventForm;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Services\QrcodeService;

#[Route('/event')]
class EventController extends AbstractController
{
 
    #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function listEvent(Request $request,PaginatorInterface $paginator, QrcodeService $qrcodeService)
    {
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
    
        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);
    
        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.nom', 'ASC')
            ->getQuery();
    
        // Paginate the results of the query
        $events = $paginator->paginate(
            // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );
      // Dans la méthode listEvent du contrôleur
// persistez l'événement pour enregistrer le nouveau QR code en base de données
    
    // Obtenez le numéro de page actuelle
    $currentPageNumber = $events->getCurrentPageNumber();

    // Obtenez le nombre total de pages disponibles
    $totalPages = $events->getPageCount();

    // Vérifiez si la page suivante existe
    $hasNextPage = $currentPageNumber < $totalPages;
     // Vérifiez si la page précédente existe
     $hasPreviousPage = $currentPageNumber > 1;
        return $this->render('event/index.html.twig', [
            'events' => $events,
            'hasNextPage' => $hasNextPage,
            'hasPreviousPage' => $hasPreviousPage,
          
        ]);
    }
    

#[Route('/event/{id}', name: 'app_event_show', methods: ['GET'])]
public function show(Event $event,QrcodeService $qrcodeService): Response
{
    $qrCode = $qrcodeService->qrcode($event->getDescription());
    return $this->render('event/show.html.twig', [
        'event' => $event,
        'qrCode' => $qrCode,
    ]);
}
#[Route('/eventfront/{id}', name: 'app_eventf_show', methods: ['GET'])]
public function showfront(Event $event,QrcodeService $qrcodeService): Response
{
    $qrCode = $qrcodeService->qrcode($event->getDescription());
    return $this->render('event/showf.html.twig', [
        'event' => $event,
        'qrCode' => $qrCode,
    ]);
}

   
    #[Route('/deleteEvent/{id}', name: 'deleteEvent')]
    public function deleteEvent($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute("app_event_index");


    }
     
    #[Route('/ajouterEvent', name: 'ajouterEvent', methods: ['GET', 'POST'])]
    public function ajouterEvent(Request $request)
    {
        $event= new Event();
        $form= $this->createForm(EventForm::class,$event);
      //  $form->add( 'ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile)
            {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $event->setImage($newFilename);
            }
 
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em-> flush();
            return $this->redirectToRoute('app_event_index');

        }
        return $this->render('event/new.html.twig', ['form' => $form->createView()]);
    }

 
    #[Route('/updateEvent/{id}', name: 'updateEvent', methods: ['GET', 'POST'])]
    public function updateEvent($id, Request $request,QrcodeService $qrcodeService)
    {
        $event= $this->getDoctrine()->getRepository(Event::class)->findBy(['id' => $id])[0];
        $form = $this->createForm(EventForm::class, $event);
          // $form->add( 'ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile)
            {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $event->setImage($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('app_event_index');

        }
        return $this->render('event/edit.html.twig', ['form' => $form->createView(),
        'id' => $id 
    ]);

    }

    #[Route('/frontEvent', name: 'frontEvent', methods: ['GET'])]
    public function listEventFront(Request $request, EventRepository $repository, PaginatorInterface $paginator)
    {
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
    
        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);
    
        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.nom', 'ASC')
            ->getQuery();
    
        // Paginate the results of the query
        $events = $paginator->paginate(
            // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );
    // Obtenez le numéro de page actuelle
    $currentPageNumber = $events->getCurrentPageNumber();

    // Obtenez le nombre total de pages disponibles
    $totalPages = $events->getPageCount();

    // Vérifiez si la page suivante existe
    $hasNextPage = $currentPageNumber < $totalPages;
     // Vérifiez si la page précédente existe
     $hasPreviousPage = $currentPageNumber > 1;
  
        return $this->render('event/frontEvent.html.twig', [
            'events' => $events,
            'hasNextPage' => $hasNextPage,
            'hasPreviousPage' => $hasPreviousPage,
            
           
        ]);
    }

    #[Route('/calendar', name: 'calendar', methods: ['GET'])]
    public function calendar(EventRepository $calendar)
    { $events=$calendar->findAll();
        $rdvs= [];
        foreach ($events as $events){
            $rdvs[]= [ 'id'=>$events->getId(),
                'date'=>$events->getDate()->format('Y-m-d H:i:s'),
                
                'image'=>$events->getImage(),
                'end'=>$events->getDate()->format('Y-m-d H:i:s'),
                'title'=>$events->getNom(),
             

            ];


        }
        $data= json_encode($rdvs);
        return $this->render('event/calendar.html.twig',compact('data') );
    }
   
    #[Route('/homefront', name: 'homefront',)]
    public function home()
    { 
           


      
        return $this->render('home.html.twig' );
    }
    
    #[Route('/events', name: 'event_list', methods: ['GET'])]
    public function eventList(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();
    
        return $this->render('event/list.html.twig', [
            'events' => $events,
        ]);
    }
    

}
