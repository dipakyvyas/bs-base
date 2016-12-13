<?php
namespace BsBase\Model\Mapper;

interface BsObjectInterface
{

    /**
     * @return string
     */
    public function __toString();

    /**
     * @param \DateTime $date
     */
    public function setCreatedAt(\DateTime $date);

    /**
     * @return \DateTime
    */
    public function getCreatedAt();

    /**
     * @param \DateTime $date
    */
    public function setDeletedAt(\DateTime $date);

    /**
     * @return \DateTime
    */
    public function getDeletedAt();

    /**
     * @param \DateTime $date
     */
    public function setModifiedAt(\DateTime $date);

    /**
     * @return \DateTime
    */
    public function getModifiedAt();

    /**
     * @return boolean
     */
    public function isPersisted();

}