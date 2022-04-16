<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Projects;
use App\Nova\Metrics\TaskLists;
use App\Nova\Metrics\Tasks;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards(): array
    {
        return [
            new Projects,
            New TaskLists,
            New Tasks,
        ];
    }
}
