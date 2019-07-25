<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormatDate
{
    public function getCreatedAtForHumansAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedAtForHumansAttribute() {
        return $this->created_at->diffForHumans();
    }

    // public function getForHumans(Carbon $date) {        
    //     if ($date > Carbon::now()->subHours(24)) {
    //         return $date->diffForHumans();
    //     }

    //     if ($date->isSameYear(Carbon::now())) {
    //         return $date->formatLocalized('%d %b');
    //     }

    //     return $date->formatLocalized('%d %b, %Y');
    // }
}