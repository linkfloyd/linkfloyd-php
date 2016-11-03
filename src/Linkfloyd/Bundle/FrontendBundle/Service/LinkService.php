<?php

namespace Linkfloyd\Bundle\FrontendBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @author Guven Atbakan <guven@atbakan.com>
 */
class LinkService
{
    
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
