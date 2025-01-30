<?php

namespace App\Modules\LeadStatus\Queries;

use App\Modules\LeadStatus\Models\LeadStatus;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LeadStatusDataTable
 */
class LeadStatusDataTable
{
    /**
     * @return LeadStatus|Builder
     */
    public function get()
    {
//        $query = LeadStatus::query()->select('lead_statuses.*')->withCount('leads')->latest();
        $query = LeadStatus::query()->select('lead_statuses.*')->latest();
//        dd('get', $query);

        return $query;
    }
}
