<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ListCarRequest extends BaseRequest
{
    private string $order;
    private string $color;
    private string $brand;
    #[Assert\NotBlank(
        allowNull: true
    )]
    private mixed $seats = null;

    /**
     * @return string
     */
    public function getOrder(): string
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
     * @return string
     */
    public function getColor(): string
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
     * @return string
     */
    public function getBrand(): string
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
     * @return int
     */
    public function getSeats(): int
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     */
    public function setSeats(mixed $seats): void
    {
        $this->seats = is_numeric($seats) ? (int)$seats : null;
    }


}