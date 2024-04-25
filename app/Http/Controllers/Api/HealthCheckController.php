<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HealthCheckController extends Controller
{
    public function check()
    {
        try {
            // Perform any necessary health checks here
            // For example, check database connection
            DB::connection()->getPdo();

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::error('Health Check Failed: '.$e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'Health check failed.'], 500);
        }
    }
}
