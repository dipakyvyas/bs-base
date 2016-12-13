<?php
namespace BsBase\Model\Mapper\ODM;

use BsBase\Model\Mapper\MapperInterface;
use BsBase\Model\Mapper\MapperInterfaceTrait;
use Doctrine\ODM\MongoDB\DocumentManager;
use BsBase\Model\Mapper\BsObjectInterface;

/**
 *
 * @author mat_wright
 *
 */
class ODMMapper implements MapperInterface
{

    use MapperInterfaceTrait;

    private $objectManager;

    public function __construct(DocumentManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \BsBase\Model\Mapper\MapperInterface::getInstance()
     */
    public function getInstance()
    {
        return $this->objectManager;
    }

    /*
     * (non-PHPdoc)
     * @see \BsFile\Model\Mapper\MapperInterface::getRepository()
     */
    public function getRepository($name)
    {
        if ($name instanceof BsObjectInterface) {
            $name = get_class($name);
            return $this->getInstance()->getRepository($name);
        }

        if (! strstr($name, '\\')) {
            $name = rtrim(preg_replace("/\\w+$/i", "", get_called_class()), '\\') . '\\Document\\' . ucfirst($name);
        }

        return $this->getInstance()->getRepository($name);
    }

    /**
     *
     * @param mixed $name
     * @throws \Exception
     */
    public function getObject($name)
    {
        if (class_exists($name)) {
            $name = new $name();
            goto gotClass;
        }

        $name = (string) $name;
        $class = '\\' . preg_replace('/\Mapper$/', 'Document\\' . ucfirst($name), get_called_class());

        if (class_exists($class)) {
            $name = new $class();
        } else {
            throw new \Exception('class ' . $class . ' does not exist');
        }
        gotClass:
        return $name;
    }
}