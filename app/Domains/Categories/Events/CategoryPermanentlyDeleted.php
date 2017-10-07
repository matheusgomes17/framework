<?php

namespace MVG\Domains\Categories\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryPermanentlyDeleted
 * @package MVG\Domains\Categories\Events
 */
class CategoryPermanentlyDeleted
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