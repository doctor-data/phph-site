<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TalkRepository
 * @package App\Repository
 */
class TalkRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getUpcomingTalks()
    {
        return $this->findBy([], ['time' => 'ASC']);
    }
}