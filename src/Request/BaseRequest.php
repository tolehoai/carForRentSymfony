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

    public function transfer(array $params, mixed $instanceOfRequest): array
    {
        $arr = [];
        foreach ($params as $key => $value) {
            $getter = 'get' . ucfirst($value);
            $arr[$value] = $instanceOfRequest->{$getter}();
        }
        return $arr;
    }

}