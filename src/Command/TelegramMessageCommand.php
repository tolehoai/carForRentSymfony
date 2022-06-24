<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:create-telegram',
)]
class TelegramMessageCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $token = "5447448320:AAGuETIkB8_sjtQEoQofntGpNovuiqkflEI";

        $data = [
            'text' => 'DMM',
            'chat_id' => '1835851199'
        ];

        file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));

        return Command::SUCCESS;
    }
}