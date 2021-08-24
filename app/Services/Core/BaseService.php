<?php

namespace App\Services\Core;

use App\Helpers\Core\Traits\HasAttr;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    use HasAttr;

    protected Model $model;

    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function __call($method, $arguments)
    {
        return $this->model->{$method}(...$arguments);
    }
}
