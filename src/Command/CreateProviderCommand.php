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
    name: 'app:create-provider',
)]
class CreateProviderCommand extends Command
{

    private SqsClient $sqsClient;
    private ParameterBagInterface $params;

    public function __construct( SqsClient $sqsClient,ParameterBagInterface $params, string $name = null,)
    {
        parent::__construct($name);
        $this->sqsClient = $sqsClient;
        $this->params = $params;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueUrl = $this->params->get('queueURL');
        $params = [
            'DelaySeconds' => 1,
            'MessageBody' => 'Send message from Provider.',
            'QueueUrl' =>  $queueUrl
        ];
        try {
            $result = $this->sqsClient->sendMessage($params);
//            var_dump($params['MessageBody']);
        } catch (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }
        $output->writeln('Send');

        return Command::SUCCESS;
    }

}