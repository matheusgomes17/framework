<?php

namespace MVG\Support\Domain\Database\Repository;

use MVG\Support\Domain\Database\Repository\Contracts\Repository as RepositoryContract;
use MVG\Support\Domain\Database\Repository\Contracts\Operations\CreateRecords as CreateRecordsContract;
use MVG\Support\Domain\Database\Repository\Contracts\Operations\ReadRecords as ReadRecordsContract;
use MVG\Support\Domain\Database\Repository\Contracts\Operations\UpdateRecords as UpdateRecordsContract;
use MVG\Support\Domain\Database\Repository\Contracts\Operations\DeleteRecords as DeleteRecordsContract;
use MVG\Support\Domain\Database\Repository\Operations\CreateRecords;
use MVG\Support\Domain\Database\Repository\Operations\DeleteRecords;
use MVG\Support\Domain\Database\Repository\Operations\ReadRecords;
use MVG\Support\Domain\Database\Repository\Operations\UpdateRecords;

/**
 * Abstract Class CrudRepository
 * @package MVG\Support\Domain\Database\Repository\Repository
 */
abstract class CrudRepository extends Repository implements RepositoryContract,
                                                   ReadRecordsContract,
                                                   CreateRecordsContract,
                                                   UpdateRecordsContract,
                                                   DeleteRecordsContract
{
    use CreateRecords,
        ReadRecords,
        UpdateRecords,
        DeleteRecords;
}