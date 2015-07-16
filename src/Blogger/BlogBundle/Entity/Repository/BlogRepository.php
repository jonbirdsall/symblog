<?php

namespace Blogger\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BlogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogRepository extends EntityRepository
{
    public function getLatestBlogs($limit = null)
    {
        $qb = $this->createQueryBuilder('b')
                ->select('b')
                ->addOrderBy('b.created', 'DESC');
        
        if (false === is_null($limit))
            $qb->setMaxResults ($limit);
        
        return $qb->getQuery()
                ->getResult();
    }
}
