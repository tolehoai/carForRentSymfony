<?php

namespace App\Service;


use App\Entity\Image;
use App\Manager\ImageManager;
use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageService
{
    private $targetDirectory;
    private $slugger;
    private ImageManager $imageManager;
    private ImageRepository $imageRepository;

    public function __construct(
        $targetDirectory,
        SluggerInterface $slugger,
        ImageManager $imageManager,
        ImageRepository $imageRepository
    ) {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->imageManager = $imageManager;
        $this->imageRepository = $imageRepository;
    }

    public function upload(UploadedFile $file): Image
    {
        $url = $this->imageManager->upload($file);
        $image = new Image();
        $image->setPath(explode('https://hoaicarforrent.s3.ap-southeast-1.amazonaws.com/', $url)[1]);
        $image->setCreatedAt(new \DateTimeImmutable());
        $this->imageRepository->add($image, true);
        return $image;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
