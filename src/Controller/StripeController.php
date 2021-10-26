<?php

namespace App\Controller;

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;

class StripeController extends AbstractController
{
    /**
     * @Route("/les-petits-conseils-de-laurie-peret", name="stripe-book")
     */
    public function index(): Response
    {
        return $this->redirect('https://laurieperet.shop');
        //return $this->render('stripe/index.html.twig');
    }

    /**
     * @Route("/create-checkout-session", name="create_checkout")
     */
    public function createCheckout(Request $request)
    {
        $dedicace = $request->get('dedicace');
        Stripe::setApiKey($this->getParameter('app.stripe_api_key'));
        $session = Session::create([
            'payment_method_types' => ['card'],
            'shipping_rates' => [$this->getParameter('app.stripe_shipping_key')],
            'shipping_address_collection' => [
                'allowed_countries' => ['FR', 'BE', 'CH'],
            ],
            'payment_intent_data' => [
                'metadata' => [
                    'cacededi' => $dedicace ?? 'Aucune dédicace'
                ]
            ],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Les petits conseils de Laurie Peret',
                    ],
                    'unit_amount' => $dedicace ? 1995 : 1500,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('home', [], UrlGenerator::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('home', [], UrlGenerator::ABSOLUTE_URL),
        ]);
        return new JsonResponse(null, 303, ['Location' => $session->url]);
    }
}
