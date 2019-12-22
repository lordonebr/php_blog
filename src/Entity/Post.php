<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
final class Post
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="50")
     */
    public string $title;

    /**
     * @ORM\Column(type="string")
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    public string $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private \Datetime $createdAt;
    
    public function __construct(string $title = null, string $description = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->createdAt = new \Datetime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt(): \Datetime
    {
        return $this->createdAt;
    }
}