<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/authenticate/{user}/{password}", name="login")
     */
    public function indexAction(Request $request, $user, $password)
    {
        return new JsonResponse([$user,$password]);
    }
}
