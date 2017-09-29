<?php

namespace MVG\Support\Domain\Database\Repository\Operations;

/**
 * Trait CreateRecords
 * @packageMVG\Support\Domain\Database\Repository\Operations
 */
trait CreateRecords
{
    /**
     * Performs the save method of the model
     * The goal is to enable the implementation of your business logic before the command.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function save($model)
    {
        return $model->save();
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data = [])
    {
        $model = $this->factory($data);

        $this->save($model);

        return $model;
    }

}