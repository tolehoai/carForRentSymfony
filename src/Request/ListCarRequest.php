<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ListCarRequest extends BaseRequest
{
    private string|null $order = null;
    private string|null $color = null;
    private string|null $brand = null;
    #[Assert\NotBlank(
        allowNull: true
    )]
    private int|null $seats = null;

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
        $this->seats = is_numeric($seats) ? (int)$seats : null;
    }


}