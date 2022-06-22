<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class ImageUploadRequest extends BaseRequest
{
    #[Assert\Image(
        maxSize: '3M',
        mimeTypes: [
            'image/jpeg',
            'image/jpg',
            'image/png'
        ],
        mimeTypesMessage: 'The type of the file is invalid ({{ type }}). Allowed types are {{ types }}.'
    )]
    private File $image;

    /**
     * @return File
     */
    public function getImage(): File
    {
        return $this->image;
    }

    /**
     * @param File $image
     */
    public function setImage(File $image): void
    {
        $this->image = $image;
    }

}