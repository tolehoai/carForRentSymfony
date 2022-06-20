<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ListCarRequest extends BaseRequest
{
    private string|null $order = null;
    private string|null $color = null;
    private string|null $brand = null;
    private string|null $price = null;
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    private mixed $seats = null;

    /**
     * @return string|null
     */
    public function getOrder(): string|null
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder(string $order): void
    {
        $this->order = $order;
    }

    /**
     * @return string|null
     */
    public function getColor(): string|null
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getBrand(): string|null
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int|null
     */
    public function getSeats(): int|null
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats(mixed $seats): void
    {
        $this->seats = is_numeric($seats) ? (int)$seats : $seats;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string|null $price
     */
    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }
}
