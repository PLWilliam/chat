<?php

namespace App\Entity;

use App\Repository\FriendsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendsRepository::class)]
class Friends
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $friend1 = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $friend2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $privateMessage = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?FriendRequestStatus $friendsRequest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFriend1(): ?User
    {
        return $this->friend1;
    }

    public function setFriend1(?User $friend1): static
    {
        $this->friend1 = $friend1;

        return $this;
    }

    public function getFriend2(): ?User
    {
        return $this->friend2;
    }

    public function setFriend2(?User $friend2): static
    {
        $this->friend2 = $friend2;

        return $this;
    }

    public function getPrivateMessage(): ?string
    {
        return $this->privateMessage;
    }

    public function setPrivateMessage(?string $privateMessage): static
    {
        $this->privateMessage = $privateMessage;

        return $this;
    }

    public function getFriendsRequest(): ?FriendRequestStatus
    {
        return $this->friendsRequest;
    }

    public function setFriendsRequest(?FriendRequestStatus $friendsRequest): static
    {
        $this->friendsRequest = $friendsRequest;

        return $this;
    }
}
