<?php

namespace App\Entity;

use App\Repository\ShortUrlRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ShortUrlRepository::class)
 * @UniqueEntity(
 *     fields={"shortlink"},
 *     errorPath="shortlink",
 *     message="This short link is already taken, please use unique string"
 * )
 */
class ShortUrl
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2000)
     * @Assert\NotBlank(
     *   message = "This field cannot be empty",
     * )
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     * )
     */
    private $fullurl;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(
     *   message = "This field cannot be empty",
     * )
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "Short URL cannot be longer than {{ limit }} characters",
     * )
     */
    private $shortlink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullurl(): ?string
    {
        return $this->fullurl;
    }

    public function setFullurl(string $fullurl): self
    {
        $this->fullurl = $fullurl;

        return $this;
    }

    public function getShortlink(): ?string
    {
        return $this->shortlink;
    }

    public function setShortlink(string $shortlink): self
    {
        $this->shortlink = $shortlink;

        return $this;
    }
}
