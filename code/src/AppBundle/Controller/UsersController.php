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
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addUserAction(Request $request)
    {
        /** @var UserManager $userManager */
        $userManager = $this->get(UserManager::class);
        try {
            $user = $userManager->create('newUser1');
            return new JsonResponse([
                'status' => 'user created',
                'user_id' => $user->getId(),
            ]);

        } catch (UniqueConstraintViolationException $exception) {
            return new JsonResponse(['error' => 'UniqueConstraintViolationException']);
         } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
         }
    }

    /**
     * @Route("/remove-user/{user}")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param User $user
     * @return JsonResponse
     *
     */
    public function removeUserAction(User $user)
    {
        /** @var UserManager $userManager */
        $userManager = $this->get(UserManager::class);
        try {
            $userManager->remove($user);
            return new JsonResponse([
                'status' => 'user removed'
            ]);

        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
        }
    }
}
