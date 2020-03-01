<?php

namespace AffectationBundle\Controller;

use AffectationBundle\Entity\Argent;
use AffectationBundle\Stripe\StripeClient;
use UserBundle\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints\NotBlank;


class DonationController extends Controller
{
    public function sucessAction()
    {
        return $this->render('@Affectation/donationCrud/sucess.html.twig');
    }

    public function echecAction()
    {
        return $this->render('@Affectation/donationCrud/echec.html.twig');
    }

    public function donateAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->get('form.factory')
            ->createNamedBuilder('payment-form')
            ->add('token', HiddenType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('submit', SubmitType::class)
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                try {
                    $this->get('Affectation.Stripe.StripeClient')->createPremiumCharge($this->getUser(), $form->get('token')->getData());
                    $redirect = $this->get('session')->get('premium_redirect');
                } catch (\Stripe\Error\Base $e) {
                    $this->addFlash('warning', sprintf('Unable to take payment, %s', $e instanceof \Stripe\Error\Card ? lcfirst($e->getMessage()) : 'please try again.'));
                    $redirect = $this->generateUrl('premium_payment');
                } finally {
                    return $this->redirect($redirect);
                }
            }
        }

        return $this->render('@Affectation/donationCrud/donationArgent.html.twig', [
            'form' => $form->createView(),
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
        ]);
    }

}