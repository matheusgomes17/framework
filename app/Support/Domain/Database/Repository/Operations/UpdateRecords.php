<?php

namespace MVG\Support\Domain\Database\Repository\Operations;

/**
 * Trait UpdateRecords
 * @package MVG\Support\Domain\Database\Repository\Operations
 */
trait UpdateRecords
{
    /**
     * Updated model data, using $data
     * The sequence performs the Model update.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     *
     * @return bool
     */
    public function update($model, array $data = [])
    {
        $this->setModelData($model, $data);

        return $this->saveForUpdate($model);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     */
    protected function setModelData($model, array $data)
    {
        $model->fill($data);
    }

    /**
     * Performs the save method of the model
     * The goal is to enable the implementation of your business logic before the command.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    protected function saveForUpdate($model)
    {
        return $model->save();
    }
}