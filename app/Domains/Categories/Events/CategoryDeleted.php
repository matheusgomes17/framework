<?php

namespace MVG\Domains\Categories\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryDeleted
 * @package MVG\Domains\Categories\Events
 */
class CategoryDeleted
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