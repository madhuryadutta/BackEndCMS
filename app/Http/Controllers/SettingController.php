<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public function install()
    {
        try {
            DB::table('users')->insert([
                'id' => 9999, 'name' => 'Default', 'email' => 'admin@backendcms.databytedigital.com', 'password' => '$2y$12$nTEasgNYfH9i7kjBdAPjU.O0HQ7xlwgccwiEoU5CF23NhaPpntqlu', 'created_at' => '2001-02-19 19:53:06', 'updated_at' => '2001-02-19 19:53:06',
            ]);
            DB::table('categories')->insert([
                'id' => 9999, 'category_name' => 'UNCATEGORIZED', 'created_at' => '2001-02-19 19:53:06', 'updated_at' => '2001-02-19 19:53:06',
            ]);
            DB::table('contents')->insert([
                'id' => 9999, 'title' => 'This is Demo Post of BackEndCMS', 'content_text' => '<p>Thank you For UsIng&nbsp;BackEndCMS</p>', 'user_id' => 9999, 'fk_category_id' => 9999, 'created_at' => '2001-02-19 19:53:06', 'updated_at' => '2001-02-19 19:53:06',
            ]);
        } catch (\Throwable $e) {
            Log::debug('There was an SQL error which was handle by a exception handling in SettingsController: '.$e->getMessage());
        } finally {
            return redirect('/');
        }
    }

    public function cachePurge($key = null)
    {
        if ($key = null) {
            // Clear all items from the cache
            Cache::flush();
        } else {

            // Or, if you want to remove a specific item from the cache
            Cache::forget($key);
        }

        return redirect('/');
    }

    public function artisanCache()
    {
        // Execute the 'view:cache' Artisan command
        Artisan::call('config:cache');
        Artisan::call('storage:link');
        Artisan::call('event:cache');
        Artisan::call('route:cache');
        Log::debug('Cached Successfully');

        return redirect('/');
    }

    public function artisanCacheClear()
    {
        // Execute the 'view:cache' Artisan command
        Artisan::call('cache:clear');
        Artisan::call('route:clear');

        return redirect('/');
        Log::debug('Cached Cleared Successfully');
    }
}
