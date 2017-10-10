<?php

namespace MVG\Domains\Categories\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryUpdated
 *
 */
class CategoryUpdated
{
    use SerializesModels;
    /**
     * @var
     */
    public $category;

    /**
     * @param $category
     */
    public function __construct($category)
    {
        $this->category = $category;
    }
}