<?php

namespace App\Request;

class ListCarRequest extends AbstractRequest
{
    private string $order;
    private string $color;
    private string $brand;
    private string $seat;
    public function fromArray(array $query)
    {
        foreach ($query as $key => $value) {
            $setter = 'set'.ucfirst($key);
            if(!method_exists($this,$setter)){
                return;
            }
            $this->{$setter}($value);
        }
    }

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
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     */
    public function setSeat(string $seat): void
    {
        $this->seat = $seat;
    }


}