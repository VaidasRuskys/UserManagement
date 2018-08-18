<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use AppBundle\Service\GroupManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupsController extends Controller
{
    /**
     * @Route("/add-group")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addGroupAction(Request $request)
    {
        /** @var GroupManager $groupManager */
        $groupManager = $this->get(GroupManager::class);
        try {
            $group = $groupManager->create('newGroup');
            return new JsonResponse([
                'status' => 'group created',
                'group_id' => $group->getId(),
            ]);
        } catch (UniqueConstraintViolationException $exception) {
            return new JsonResponse(['error' => 'UniqueConstraintViolationException']);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
        }
    }

    /**
     * @Route("/remove-group/{group}")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Group $group
     * @return JsonResponse
     *
     */
    public function removeGroupAction(Group $group)
    {
        /** @var GroupManager $groupManager */
        $groupManager = $this->get(GroupManager::class);
        try {
            $groupManager->remove($group);
            return new JsonResponse([
                'status' => 'group removed'
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
        }
    }

    /**
     * @Route("/group-add-user/{group}/{user}")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Group $group
     * @param User $user
     * @return JsonResponse
     *
     */
    public function addUserAction(Group $group, User $user)
    {
        /** @var GroupManager $groupManager */
        $groupManager = $this->get(GroupManager::class);
        try {
            $groupManager->addUser($group, $user);
            return new JsonResponse([
                'status' => 'user added to group'
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
        }
    }

    /**
     * @Route("/group-remove-user/{group}/{user}")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Group $group
     * @param User $user
     * @return JsonResponse
     *
     */
    public function removeUserAction(Group $group, User $user)
    {
        /** @var GroupManager $groupManager */
        $groupManager = $this->get(GroupManager::class);
        try {
            $groupManager->removeUser($group, $user);
            return new JsonResponse([
                'status' => 'user removed from group'
            ]);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()]);
        }
    }
}
