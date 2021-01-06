<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

class GiftsService {

    public $gifts = ['flowers', 'car'];

    public function __construct(LoggerInterface $logger)
    {
        $logger->info('Gifts wer randomized!');
        shuffle($this->gifts);
    }

}