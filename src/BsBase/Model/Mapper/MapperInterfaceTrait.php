<?php
namespace BsBase\Model\Mapper;

trait MapperInterfaceTrait
{

    /**
     * Saves a BsObject to the database
     *
     * @param BsObjectInterface $object
     */
    public function save(BsObjectInterface $object, $flush = true)
    {
        if (! $object->isPersisted()) {
            $this->getInstance()->persist($object);
        }
        if ($flush) {
            $this->getInstance()->flush();
        }
    }

    /**
     * Deletes a BsObject from the database
     *
     * @param BsObjectInterface $object
     */
    public function delete(BsObjectInterface $object, $flush = true)
    {
        $this->getInstance()->remove($object);
        if (!$object instanceof SoftDeletableInterface && $flush) {
            $this->getInstance()->flush();
        }
    }

    public function __invoke()
    {
        return $this->getInstance();
    }
}
