<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('activityLog')) {

    function activityLog($action, $description)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'      => $action,
            'description' => $description,
        ]);
    }

}