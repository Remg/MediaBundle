<?php

namespace Remg\MediaBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Remg\MediaBundle\Model\File;

/**
 * @ORM\MappedSuperclass
 */
class Image extends File
{
    const UPLOAD_DIRECTORY = 'uploads/images';
    const DEFAULT_IMAGE = null;

    /**
     * Image file
     *
     * @var File
     *
     * @Assert\Image(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "The maxmimum allowed file size is 2MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     */
    protected $file;

    public function getWebPath()
    {
        if (null !== $webPath = parent::getWebPath()) {
            return $webPath;
        }

        return static::DEFAULT_IMAGE;
    }
}