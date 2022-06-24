<?php

namespace App\Command;

use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand(
    name: 'app:create-worker',
)]
class CreateWorkerCommand extends Command
{
    private SqsClient $sqsClient;
    private ParameterBagInterface $params;

    public function __construct(SqsClient $sqsClient, ParameterBagInterface $params, string $name = null,)
    {
        parent::__construct($name);
        $this->sqsClient = $sqsClient;
        $this->params = $params;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueUrl = $this->params->get('queueURL');

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