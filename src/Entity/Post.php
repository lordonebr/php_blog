<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column()
     */
    public string $title;

    /**
     * @ORM\Column()
     */
    public string $descripion;

    /**
     * @ORM\Column(type="datetime")
     */
    private \Datetime $createdAt;
    
    public function __construct(string $title, string $descripion)
    {
        $this->title = $title;
        $this->descripion = $descripion;
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