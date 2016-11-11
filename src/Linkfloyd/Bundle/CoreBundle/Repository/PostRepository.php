<?php
/**
 * @author Guven Atbakan <guven@atbakan.com>
 */

namespace Linkfloyd\Bundle\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findPosts()
    {
        return $this->createQueryBuilder('post')
            ->select('post', 'linkDetail', 'user', 'detail')
            ->join('post.linkDetail', 'linkDetail')
            ->join('post.user', 'user')
            ->join('post.detail', 'detail')
            ->orderBy('post.id', 'DESC')
            ->getQuery();
    }
}
