<?php

namespace App\Twig;

use App\Repository\AlertMessagesRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Header{

    public bool $displayAlert;

    private AlertMessagesRepository $alertMessagesRepository;

    public function __construct(AlertMessagesRepository $alertMessagesRepository, ?bool $displayAlert = false)
    {
        $this->alertMessagesRepository = $alertMessagesRepository;
        $this->displayAlert = $displayAlert;
    }

    public function getAlert(): array
    {

        $alertMessages = [];

        if($this->displayAlert){

            $alertMessages = $this->alertMessagesRepository->findAll();

        }
        

        return $alertMessages;
    }

}