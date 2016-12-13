<?php
namespace BsBase\Model\Mapper\ODM\Event;

use Doctrine\Common\EventSubscriber;
use Doctrine\ODM\MongoDB\Events;
use BsBase\Model\Mapper\BsObjectInterface;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use BsBase\Model\Mapper\SoftDeletableInterface;

/**
 *
 * @author mat_wright
 *
 */
class Subscriber implements EventSubscriber
{

    protected $odm;

    protected $toFlush = [];

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        $this->odm = $eventArgs->getDocumentManager();
        $document = $eventArgs->getObject();
        if ($document instanceof BsObjectInterface) {
            $document->setModifiedAt(new \DateTime());
            $eventArgs->getDocumentManager()
                ->getUnitOfWork()
                ->recomputeSingleDocumentChangeSet(new ClassMetadata(get_class($document)), $document);
        }
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $this->odm = $eventArgs->getDocumentManager();
        $document = $eventArgs->getObject();
        if ($document instanceof BsObjectInterface) {
            $document->setCreatedAt(new \DateTime());
        }
    }

    public function preRemove(\Doctrine\ODM\MongoDB\Event\LifecycleEventArgs $eventArgs)
    {
        $this->odm = $eventArgs->getDocumentManager();
        $document = $eventArgs->getDocument();
        if ($document instanceof SoftDeletableInterface) {
            $document->setDeletedAt(new \DateTime());
            $eventArgs->getDocumentManager()->detach($document);
            $object = $eventArgs->getDocumentManager()->merge($document);
            $this->toFlush[] = $object;
        }
    }

    /*
     * (non-PHPdoc)
     * @see \Doctrine\Common\EventSubscriber::getSubscribedEvents()
     */
    public function getSubscribedEvents()
    {
        return [

            Events::preUpdate,
            Events::prePersist,
            Events::preRemove
        ];
    }

    public function __destruct()
    {
        foreach ($this->toFlush as $document) {
            $this->odm->flush($document);
        }
    }
}
