<?php

namespace App\Controller;

use App\Entity\JournalDeBord;
use App\Repository\JournalDeBordRepository;
use DateTime as GlobalDateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class FarmToolsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('farm_tools/index.html.twig', [
            'controller_name' => 'FarmToolsController',
        ]);
    }

    /**
     * @Route("/journal-de-bord/write", name="journal_de_bord_new")
     */
    public function journalDeBordNew(Request $request, EntityManagerInterface $em): Response
    {
        $jdb = new JournalDeBord();

        $form = $this->createFormBuilder($jdb)
                ->add('contenu',TextareaType::class,[
                    'label'=>'Qu\'ai je fais aujour\'hui ?',
                    'attr'=>[
                        'required'=>true,
                        'class'=> 'form-control'
                    ]
                ])
                ->add('save',SubmitType::class,[
                    'attr'=>[
                        'class'=> 'btn btn-primary'
                    ]
                ])
                
                ->getForm();

                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){
                    $jdb = $form->getData();
                    $jdb->setDate(new GlobalDateTime('now',new DateTimeZone('Europe/Paris')));
                    dump($jdb);
                    $em->persist($jdb);
                    $em->flush();

                }
            
        return $this->render('farm_tools/journal_de_bord_new.html.twig', [
            'form'=>$form->createView()
        ]);
    }


    /**
     * @Route("/journal-de-bord", name="journal_de_bord_index")
     */
    public function journalDeBordIndex(JournalDeBordRepository $journalDeBordRepository)
    {
        $jdb = $journalDeBordRepository->findAll();

        $hist = [];

        foreach ($jdb as $day) {
            $hist[] = [
                'id'=> $day->getId(),
                'title'=> 'Activité du '.$day->getDate()->format('d/m/y'),
                'start'=>$day->getDate()->format('Y-m-d H:i:s'),
                'end'=>$day->getDate()->format('Y-m-d H:i:s'),
                'description'=>$day->getContenu(),
                'allDay'=>true,
            ];
        }

        $data = json_encode($hist);
        return $this->render('farm_tools/journal_de_bord_index.html.twig',[
            'data'=>$data
        ]);

    }
}
