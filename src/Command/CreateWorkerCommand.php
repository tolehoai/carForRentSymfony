<?php

namespace App\Command;

use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-worker',
)]
class CreateWorkerCommand extends Command
{
    private SqsClient $sqsClient;

    public function __construct( SqsClient $sqsClient, string $name = null,)
    {
        parent::__construct($name);
        $this->sqsClient = $sqsClient;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {

        $queueUrl = 'https://sqs.ap-southeast-1.amazonaws.com/571094829556/tolehoai';

        try {
            $result = $this->sqsClient->receiveMessage(array(
                'AttributeNames' => ['SentTimestamp'],
                'MaxNumberOfMessages' => 1,
                'MessageAttributeNames' => ['All'],
                'QueueUrl' => $queueUrl, // REQUIRED
                'WaitTimeSeconds' => 0,
            ));
            if (!empty($result->get('Messages'))) {
                var_dump($result->get('Messages')[0]['Body']);
                $result = $this->sqsClient->deleteMessage([
                    'QueueUrl' => $queueUrl, // REQUIRED
                    'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle'] // REQUIRED
                ]);
            } else {
                echo "No messages in queue. \n";
            }
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
        $output->writeln('Received');

        return Command::SUCCESS;
    }
}