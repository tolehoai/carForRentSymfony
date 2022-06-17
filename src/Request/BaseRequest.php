<?php

namespace App\Request;

class BaseRequest
{
    public function fromArray(array $query)
    {
        foreach ($query as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (!method_exists($this, $setter) || $value == '') {
                continue;
            }
            $this->{$setter}($value);

        }
        return $this;
    }
}