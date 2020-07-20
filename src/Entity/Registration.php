<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity
 */
class Registration
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public ?int $id;

    /**
     * @var string $name De naam van de registratie
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    public string $name;

    /**
     * @var string $emailAddress Het e-mailadres van de registratie
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Email
     */
    public string $emailAddress;
}