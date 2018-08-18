<?php

namespace AppBundle\Service\Exception;

/**
 * Class GroupNameInvalidException
 */
class GroupNameInvalidException extends \Exception
{
    /**
     * Class constructor
     *
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct($code = 0, \Throwable $previous = null)
    {
        parent::__construct(
            'Group name is invalid',
            $code,
            $previous
        );
    }
}
