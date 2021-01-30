<?php

namespace App\Controller;

use App\Entity\JournalDeBord;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
    public function journalDeBordNew(Request $request): Response
    {
        $jdb = new JournalDeBord();
        $jdb->setDate(new \DateTime());

        $form = $this->createFormBuilder($jdb)
                ->add('corps',TextareaType::class,[
                    'label' => 'Qu\'ai je fais aujourd\'hui ?',
                    'attr'=>[
                        'require'=>true,
                        'class'=>'form-control'
                    ]
                ])
                ->add('save',SubmitType::class,[
                    'label'=>'Ajouter au journal',
                    'attr'=>[

                        'class'=>'btn btn-primary'
                    ]
                    ])
                ->getForm();
        return $this->render('farm_tools/journal_de_bord_new.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
