<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Service\UserManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends Controller
{
    /**
     * @Route("/add-user")
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addUserAction(Request $request)
    {
        /** @var UserManager $userManager */
        $userManager = $this->get(UserManager::class);
        try {
            $user = $userManager->create('newUser1');
            return new JsonResponse([
                'status' => 'user created',
                'userId' => $user->getId(),
            ]);

        }catch (UniqueConstraintViolationException $exception) {
            return new JsonResponse(['error' => 'UniqueConstraintViolationException']);
         } catch (\Exception $exception) {
            throw $exception;
            return new JsonResponse(['error' => $exception->getMessage()]);
         }
    }
}
