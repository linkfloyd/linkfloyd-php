<?php

namespace Linkfloyd\Bundle\CoreBundle\Controller;

use Linkfloyd\Bundle\UserBundle\Entity\User;

class UserController extends BaseController
{
    public function profileAction($username)
    {
        $this->denyAccessUnlessGranted(User::ROLE_DEFAULT);
    }
}
