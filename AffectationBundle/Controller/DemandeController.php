<?php

namespace AffectationBundle\Controller;

use AffectationBundle\Entity\Demande;
use AffectationBundle\Form\SearchDemandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DemandeController extends Controller
{
    public function readAction(Request $request)
    {
        $demandes = new Demande();
        $form = $this->createForm(SearchDemandeType::class,$demandes);
        $form = $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $demandes = $this->getDoctrine()
                ->getRepository(Demande::class)
                ->findDemande($demandes->getRemarque());

            return $this->render('@Affectation/demandeCrud/lecture.html.twig', array(
                'form'=>$form->createView(),
                'demandes' => $demandes));
        }
        else {

            $em = $this->getDoctrine()->getManager();

            $demandes = $em->getRepository('AffectationBundle:Demande')->findAll();

            return $this->render('@Affectation/demandeCrud/lecture.html.twig', array(
                'form'=>$form->createView(),
                'demandes' => $demandes));
        }
    }

    public function newAction(Request $request)
    {
        $demande = new Demande();
        $form = $this->createForm('AffectationBundle\Form\DemandeType', $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('demandeCrud_read');
        }

        return $this->render('@Affectation/demandeCrud/ajout.html.twig', array(
            'form' => $form->createView()));
    }

    public function showAction(Demande $id)
    {
        $demande=$this->getDoctrine()->getRepository(Demande::class)->find($id);
        $form = $this->createForm('AffectationBundle\Form\DemandeType', $demande);

        return $this->render('@Affectation/demandeCrud/details.html.twig',
            array('form' => $form->createView()));
    }

    public function editAction(Request $request, Demande $id)
    {
        $demande=$this->getDoctrine()->getRepository(Demande::class)->find($id);
        $form = $this->createForm('AffectationBundle\Form\DemandeType', $demande);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em=$this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('demandeCrud_read');
        }

        return $this->render('@Affectation/demandeCrud/modification.html.twig',
            array('form' => $form->createView()));
    }

    public function deleteAction(Request $request, Demande $id)
    {
        $demande=$this->getDoctrine()->getRepository(Demande::class)->find($id);
        $form = $this->createForm('AffectationBundle\Form\DemandeType', $demande);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em=$this->getDoctrine()->getManager();
            $em->remove($demande);
            $em->flush();

            return $this->redirectToRoute('demandeCrud_read');
        }

        return $this->render('@Affectation/demandeCrud/suppression.html.twig',
            array('form' => $form->createView()));
    }

}
