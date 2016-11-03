<?php

namespace Linkfloyd\Bundle\FrontendBundle\Service;

/**
 * @author Guven Atbakan <guven@atbakan.com>
 */
class MediaService
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
