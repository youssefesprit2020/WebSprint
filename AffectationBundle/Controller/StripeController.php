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
use AffectationBundle\Event\StripeEvent;
use Stripe\Error\SignatureVerification;
use Stripe\Webhook;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/stripe")
 */
class StripeController extends Controller
{
    /**
     * @Route("/wh", name="stripe_webhook")
     * @param Request $request
     * @return Response
     * @throws BadRequestHttpException
     */
    public function webhookAction(Request $request)
    {
        $header = 'Stripe-Signature';
        $signature = $request->headers->get($header);

        if (is_null($signature)) {
            throw new BadRequestHttpException(sprintf('Missing header %s', $header));
        }

        try {
            $event = new StripeEvent(Webhook::constructEvent($request->getContent(), $signature, $this->getParameter('stripe_signing_secret')));
        } catch (\UnexpectedValueException $e) {
            throw new BadRequestHttpException('Invalid Stripe payload');
        } catch (SignatureVerification $e) {
            throw new BadRequestHttpException('Invalid Stripe signature');
        }

        $this->get('event_dispatcher')->dispatch($event->getName(), $event);

        return new Response();
    }
}