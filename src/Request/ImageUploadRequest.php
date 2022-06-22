<?php

namespace App\Request;

use Symfony\Component\HttpFoundation\File\File;

class ImageUploadRequest extends BaseRequest
{
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