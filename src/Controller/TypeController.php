<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Type;
use App\Form\TypeForm;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
#[Route('/type')]
class TypeController extends AbstractController
{
  
    #[Route('/', name: 'app_type_index', methods: ['GET'])]
    public function listType(Request $request, TypeRepository $repository, PaginatorInterface $paginator)
    {
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();
    
        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Type::class);
    
        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.category', 'ASC')
            ->getQuery();
    
        // Paginate the results of the query
        $types = $paginator->paginate(
            // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );
    // Obtenez le numéro de page actuelle
    $currentPageNumber = $types->getCurrentPageNumber();

    // Obtenez le nombre total de pages disponibles
    $totalPages = $types->getPageCount();

    // Vérifiez si la page suivante existe
    $hasNextPage = $currentPageNumber < $totalPages;
     // Vérifiez si la page précédente existe
     $hasPreviousPage = $currentPageNumber > 1;
        return $this->render('type/index.html.twig', [
            'types' => $types,
            'hasNextPage' => $hasNextPage,
            'hasPreviousPage' => $hasPreviousPage,
        ]);
    }
    
   
   
    #[Route('/deleteType/{id}', name: 'deleteType')]
    public function deleteType($id)
    {
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository(Type::class)->find($id);
        $em->remove($type);
        $em->flush();
        return $this->redirectToRoute("app_type_index");


    }
     
    #[Route('/ajouterType', name: 'ajouterType', methods: ['GET', 'POST'])]
    public function ajouterType(Request $request)
    {
        $event= new Type();
        $form= $this->createForm(TypeForm::class,$event);
      //  $form->add( 'ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
 
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em-> flush();
            return $this->redirectToRoute('app_type_index');

        }
        return $this->render('type/new.html.twig', ['form' => $form->createView()]);
    }


 
    #[Route('/updateType/{id}', name: 'updateType', methods: ['GET', 'POST'])]
    public function updateType($id, Request $request)
    {
        $type= $this->getDoctrine()->getRepository(Type::class)->findBy(['id' => $id])[0];
        $form = $this->createForm(TypeForm::class, $type);
          // $form->add( 'ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_type_index');

        }
        return $this->render('type/edit.html.twig', ['form' => $form->createView(),
        'id' => $id 
    ]);

    }
}
