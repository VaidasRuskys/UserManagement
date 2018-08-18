<?php

namespace AppBundle\Service\Exception;

/**
 * Class GroupNotEmptyException
 */
class GroupNotEmptyException extends \Exception
{
    /**
     * Class constructor
     *
     * @param integer         $groupId
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($groupId, $code = 0, \Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Group %s is not empty', $groupId),
            $code,
            $previous
        );
    }
}