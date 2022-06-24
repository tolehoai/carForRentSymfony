<?php

namespace App\Request;
use Symfony\Component\Validator\Constraints as Assert;
class UpdateCarRequest extends BaseRequest
{
    private const SEAT_CHOICE = [4, 7, 16];
    private string|null $id = null;
    private string|null $created_user = null;
    private string|null $thumbnail = null;
    private string|null $name = null;
    private string|null $description = null;
    private string|null $color = null;
    private string|null $brand = null;
    #[Assert\Type('float')]
    private $price = null;
    #[Assert\Choice(
        choices: self::SEAT_CHOICE,
    )]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    private $seats = null;
    #[Assert\Type('integer')]
    private $year = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getCreatedUser(): ?string
    {
        return $this->created_user;
    }

    /**
     * @param string|null $created_user
     */
    public function setCreatedUser(?string $created_user): void
    {
        $this->created_user = $created_user;
    }

    /**
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param string|null $thumbnail
     */
    public function setThumbnail(?string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @param string|null $brand
     */
    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return null
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param null $seats
     */
    public function setSeats($seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return null
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param null $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

}

