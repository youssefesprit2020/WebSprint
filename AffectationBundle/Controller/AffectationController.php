<?php

namespace AffectationBundle\Controller;

use AffectationBundle\Entity\Affectation;
use AffectationBundle\Repository\AffectationRepository;
use AffectationBundle\Form\SearchAffectationType;
use AffectationBundle\Form\AffectationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Affectation controller.
 *
 * @Route("affectationCrud")
 */
class AffectationController extends Controller
{

    public function readAction(Request $request)
    {
        $affectations = new Affectation();
        $form = $this->createForm(SearchAffectationType::class,$affectations);
        $form = $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $affectations = $this->getDoctrine()
                ->getRepository(Affectation::class)
                ->findAffectation($affectations->getRemarque());

            return $this->render('@Affectation/affectationCrud/lecture.html.twig', array(
                'form'=>$form->createView(),
                'affectations' => $affectations));
        }

        else {

        $em = $this->getDoctrine()->getManager();

        $affectations = $em->getRepository('AffectationBundle:Affectation')->findAll();

        return $this->render('@Affectation/affectationCrud/lecture.html.twig', array(
            'form'=>$form->createView(),
            'affectations' => $affectations));
        }
    }

    public function newAction(Request $request)
    {
        $affectation = new Affectation();
        $form = $this->createForm('AffectationBundle\Form\AffectationType', $affectation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($affectation);
            $em->flush();

            return $this->redirectToRoute('affectationCrud_read');
        }

        return $this->render('@Affectation/affectationCrud/ajout.html.twig', array(
            'form' => $form->createView()));
    }

    public function showAction(Affectation $id)
    {
        $affectation=$this->getDoctrine()->getRepository(Affectation::class)->find($id);
        $form = $this->createForm('AffectationBundle\Form\AffectationType', $affectation);

        return $this->render('@Affectation/affectationCrud/details.html.twig',
            array('form' => $form->createView()));
    }

    public function editAction(Request $request, Affectation $id)
    {
        $affectation=$this->getDoctrine()->getRepository(Affectation::class)->find($id);
        $form = $this->createForm('AffectationBundle\Form\AffectationType', $affectation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em=$this->getDoctrine()->getManager();
            $em->persist($affectation);
            $em->flush();

            return $this->redirectToRoute('affectationCrud_read');
        }

        return $this->render('@Affectation/affectationCrud/modification.html.twig',
            array('form' => $form->createView()));
    }

    public function deleteAction(Request $request, Affectation $id)
    {
        $affectation=$this->getDoctrine()->getRepository(Affectation::class)->find($id);
        $form = $this->createForm('AffectationBundle\Form\AffectationType', $affectation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em=$this->getDoctrine()->getManager();
            $em->remove($affectation);
            $em->flush();

            return $this->redirectToRoute('affectationCrud_read');
        }

        return $this->render('@Affectation/affectationCrud/suppression.html.twig',
            array('form' => $form->createView()));

    }

}
