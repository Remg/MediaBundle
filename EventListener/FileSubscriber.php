<?php

namespace Remg\MediaBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Remg\MediaBundle\Model\File;

class FileSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            Events::onFlush,
        );
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $entities = $uow->getScheduledEntityUpdates();

        foreach ($entities as $entity) {
            //
            if ($entity instanceof File) {
                if (true === $entity->getRemove()) {
                    $em->remove($entity);
                    continue;
                }
            }
        }
    }
}