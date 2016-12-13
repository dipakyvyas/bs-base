<?php
namespace BsBase\Service;

use BsBase\Model\Mapper\BsObjectInterface;
use BsBase\Model\Mapper\MapperInterface;

/**
 *
 * @author mat_wright
 *
 */
interface ServiceInterface
{

    /**
     * @param BsObjectInterface $object
     */
    public function save(BsObjectInterface $object);

    /**
     * @param BsObjectInterface $object
     */
    public function delete(BsObjectInterface $object);

    /**
     * @param MapperInterface $mapper
     */
    public function getMapper(MapperInterface $mapper);

}