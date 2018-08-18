<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Service\UserManager;
use Doctrine\DBAL\Exception\ConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function addUserAction(Request $request)
    {
        /** @var UserManager $userManager */
        $userManager = $this->get(UserManager::class);
        try {
            $user = $userManager->create($request->get('userName'));
            return new JsonResponse([
                'status' => 'user created',
                'user_id' => $user->getId(),
            ]);
        } catch (ConstraintViolationException $exception) {
            return new JsonResponse(['error' => $exception->getPrevious()->getMessage()]);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
        }
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function removeUserAction(User $user)
    {
        /** @var UserManager $userManager */
        $userManager = $this->get(UserManager::class);
        try {
            $userManager->remove($user);
            return new JsonResponse(
                [
                    'status' => 'user removed'
                ]
            );
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
        }
    }
}
