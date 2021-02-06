<?php

namespace App\Controller;

use App\Entity\MachineType;
use App\Form\MachineTypeType;
use App\Repository\MachineTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/machine-type")
 */
class MachineTypeController extends AbstractController
{
    /**
     * @Route("/", name="machine_type_index", methods={"GET"})
     */
    public function index(MachineTypeRepository $machineTypeRepository): Response
    {
        return $this->render('machine_type/index.html.twig', [
            'machine_types' => $machineTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="machine_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $machineType = new MachineType();
        $form = $this->createForm(MachineTypeType::class, $machineType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($machineType);
            $entityManager->flush();

            return $this->redirectToRoute('machine_type_index');
        }

        return $this->render('machine_type/new.html.twig', [
            'machine_type' => $machineType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="machine_type_show", methods={"GET"})
     */
    public function show(MachineType $machineType): Response
    {
        return $this->render('machine_type/show.html.twig', [
            'machine_type' => $machineType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="machine_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MachineType $machineType): Response
    {
        $form = $this->createForm(MachineTypeType::class, $machineType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('machine_type_index');
        }

        return $this->render('machine_type/edit.html.twig', [
            'machine_type' => $machineType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="machine_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MachineType $machineType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$machineType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($machineType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('machine_type_index');
    }
}
