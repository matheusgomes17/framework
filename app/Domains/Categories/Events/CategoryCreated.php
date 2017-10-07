<?php

namespace MVG\Domains\Categories\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryCreated
 * @package MVG\Domains\Categories\Events
 */
class CategoryCreated
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