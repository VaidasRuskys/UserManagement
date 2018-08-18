<?php

namespace AppBundle\Service\Exception;

/**
 * Class UserNameInvalidException
 */
class UserNameInvalidException extends \Exception
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
            'User name is invalid',
            $code,
            $previous
        );
    }
}
