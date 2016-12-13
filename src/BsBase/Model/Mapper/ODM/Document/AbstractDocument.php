<?php
namespace BsBase\Model\Mapper\ODM\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use BsBase\Model\Mapper\BsObjectInterface;

/**
 *
 * @author matwright
 *         @ODM\MappedSuperclass
 */
abstract class AbstractDocument implements BsObjectInterface
{

    /**
     *
     * @var string @ODM\Id
     */
    protected $id;

    /**
     *
     * @var string @ODM\Date
     */
    protected $createdAt;

    /**
     *
     * @var string @ODM\Date
     */
    protected $modifiedAt;

    /**
     *
     * @var string @ODM\Date
     */
    protected $deletedAt;

    /**
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return \DateTime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     *
     * @return \DateTime $modifiedAt
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     *
     * @return \DateTime $deletedAt
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     *
     * @param \DateTime $modifiedAt
     */
    public function setModifiedAt(\DateTime $modifiedAt = null)
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     *
     * @param \DateTime $deletedAt
     */
    public function setDeletedAt(\DateTime $deletedAt = null)
    {
        $this->deletedAt = $deletedAt;
    }

    /*
     * (non-PHPdoc)
     * @see \BsBase\Model\Mapper\BsObjectInterface::__toString()
     */
    public function __toString()
    {
        return $this->getId();
    }

    /*
     * (non-PHPdoc)
     * @see \BsBase\Model\Mapper\BsObjectInterface::isPersisted()
     */
    public function isPersisted()
    {
        return ! empty($this->getId());
    }
}
