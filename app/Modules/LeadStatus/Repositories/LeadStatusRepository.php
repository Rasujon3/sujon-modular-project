<?php

namespace App\Modules\LeadStatus\Repositories;

use App\Repositories\BaseRepository;
use App\Modules\LeadStatus\Models\LeadStatus;

/**
 * Class LeadStatusRepository
 *
 * @version April 6, 2020, 4:03 am UTC
 */
class LeadStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'color',
        'order',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LeadStatus::class;
    }
}
