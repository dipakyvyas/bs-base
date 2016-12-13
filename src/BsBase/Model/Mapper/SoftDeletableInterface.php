<?php
namespace BsBase\Model\Mapper;

/**
 *
 * @author mat_wright
 *
 */
interface SoftDeletableInterface
{

    /**
     *
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt);
}