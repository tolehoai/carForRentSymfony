<?php

namespace App\Manager;

use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;

class ImageManager extends AbstractController
{

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
    public function __construct()
    {
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

    public function upload(File $file)
    {
        $fileName = $file->getFilename() . "." . explode("/", $file->getMimeType())[1];
        $fileContent = $file->getContent();

        return $this->getClient()->upload($this->getBucket(), $fileName, $fileContent)->toArray()['ObjectURL'];
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
