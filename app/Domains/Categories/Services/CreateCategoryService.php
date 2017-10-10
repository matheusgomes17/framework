<?php

namespace MVG\Domains\Categories\Services;

use Illuminate\Support\Facades\DB;
use MVG\Domains\Categories\Events\CategoryCreated;
use MVG\Domains\Categories\Exceptions\CategoryException;
use MVG\Domains\Categories\Models\Category;

/**
 * Class CreateCategoryService
 *
 */
class CreateCategoryService extends AbstractService
{
    /**
     * @param  $data
     *
     * @return mixed
     */
    protected function createCategoryStub($data = [])
    {
        $category = [
            'name' => $data['name'],
            'description' => $data['description'],
        ];

        return $category;
    }

    public function create(array $data) : Category
    {
        return DB::transaction(function () use ($data) {

            $category = $this->userRepository->create($this->createCategoryStub($data));

            if ($category) {

                event(new CategoryCreated($category));

                return $category;
            }

            throw new CategoryException(__('category::exceptions.create_error'));
        });
    }
}