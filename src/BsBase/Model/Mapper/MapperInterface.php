<?php
namespace BsBase\Model\Mapper;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

interface MapperInterface
{

    /**
     * Get an ObjectManager Instance
     *
     * @return ObjectManager
     */
    public function getInstance();

    /**
     * Get an objects repository
     * Returns a repository object for the give BsObjectInterface or entity name.
     *
     * @param
     *            BsObjectInterface|string
     * @return ObjectRepository
     */
    public function getRepository($name);

    /**
     * Save a BsObjectInterface
     *
     * @param BsObjectInterface $object
     * @param boolean $flush
     */
    public function save(BsObjectInterface $object, $flush = true);

    /**
     * Delete a BsObjectInterface
     *
     * @param BsObjectInterface $object
     * @param boolean $flush
     */
    public function delete(BsObjectInterface $object, $flush = true);

    /**
     *
     * @param BsObjectInterface $name
     */
    public function getObject($name);
}