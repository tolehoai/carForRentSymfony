<?php

namespace App\Manager;

use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageManager extends AbstractController
{
    private $slugger;
    /**
     * @var S3Client
     */
    private $client;

    /**
     * @var string
     */
    private $bucket;

    /**
     * @param string $bucket
     * @param array $s3arguments
     */
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
        $this->setBucket($_ENV['BUCKET_NAME']);
        $this->setClient(
            new S3Client([
                'version' => $_ENV['VERSION'],
                'region' => $_ENV['REGION'],
                'credentials' => ['key' => $_ENV['AWS_S3_ACCESS_ID'], 'secret' => $_ENV['AWS_S3_ACCESS_SECRET']]
            ])
        );
    }

    /**
     * Setter of bucket
     *
     * @param string $bucket
     *
     * @return $this
     */
    private function setBucket($bucket)
    {
        $this->bucket = $bucket;

        return $this;
    }

    /**
     * Setter of client
     *
     * @param S3Client $client
     *
     * @return $this
     */
    private function setClient(S3Client $client)
    {
        $this->client = $client;

        return $this;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = $this->getFileName($file);
        $file->move($this->getTargetDirectory(), $fileName);
        $filePath = $this->getPath($fileName);
        $s3UploadURL = $this->s3Upload($fileName, $filePath);
        unlink($filePath);
        return $s3UploadURL->get('ObjectURL');
    }

    public function getFileName(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        return $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
    }

    public function getTargetDirectory()
    {
        return $this->getParameter('brochures_directory');
    }

    public function getPath($fileName)
    {
        return $this->getTargetDirectory() . $fileName;
    }

    public function s3Upload($fileName, $filePath)
    {
        return $s3UploadURL = $this->getClient()->putObject([
            'Bucket' => $this->getBucket(),
            'Key' => 'carImages/' . $fileName,
            'SourceFile' => $filePath,
        ]);
    }

    /**
     * Getter of client
     *
     * @return S3Client
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * Getter of bucket
     *
     * @return string
     */
    protected function getBucket()
    {
        return $this->bucket;
    }

}
