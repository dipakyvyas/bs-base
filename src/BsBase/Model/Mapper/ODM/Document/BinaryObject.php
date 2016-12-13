<?php
namespace BsBase\Model\Mapper\ODM\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Store small binary objects
 * 
 * Embedded document for storing small binary files
 * for files > 16 MB use BsFile
 * 
 * @author matwright
 * @ODM\EmbeddedDocument
 */
class BinaryObject extends AbstractBinaryObject
{
}