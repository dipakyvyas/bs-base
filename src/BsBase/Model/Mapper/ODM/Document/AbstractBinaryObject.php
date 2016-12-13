<?php
namespace BsBase\Model\Mapper\ODM\Document;

use BsBase\Model\Mapper\BinaryObjectInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Abstract binary object
 *
 * @author matwright
 *         @ODM\MappedSuperclass
 */
abstract class AbstractBinaryObject implements BinaryObjectInterface
{

    /**
     *
     * @var string @ODM\Field(type="string")
     */
    protected $mime;

    /**
     *
     * @var string @ODM\Bin
     */
    protected $binary;

    /**
     *
     * @var string @ODM\Field(type="string")
     */
    protected $filename;

    /**
     *
     * @return string $mime
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     *
     * @return string $binary
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     *
     * @return string $filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     *
     * @param string $mime
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
    }

    /**
     *
     * @param string $binary
     *
     */
    public function setBinary($binary)
    {
        $this->binary = $binary;
    }

    /**
     *
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }
}