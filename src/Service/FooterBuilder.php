<?php

namespace App\Service;

use App\Repository\ContactRepository;
use App\Repository\SocialRepository;

class FooterBuilder
{
    private $socialRepository;

    private $contactRepository;

    public function __construct(SocialRepository $socialRepository, ContactRepository $contactRepository)
    {
        $this->socialRepository = $socialRepository;
        $this->contactRepository = $contactRepository;
    }

    public function getSocials()
    {
        return $this->socialRepository->findAll();
    }

    public function getContacts()
    {
        return$this->contactRepository->findAll();
    }
}