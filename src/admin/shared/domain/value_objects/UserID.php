<?php

namespace Src\admin\shared\domain\value_objects;

final class UserID
{
    private $value;

    function __construct($id)
    {
        $this->value = $id;
    }

    public function value()
    {
        return $this->value;
    }
}
