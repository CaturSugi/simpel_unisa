<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Trash;
use Carbon\Carbon;

class DeleteOldRecords extends Command
{
    // protected $signature = 'app:delete-old-records';
    protected $signature = 'records:cleanup';
    protected $description = 'Delete records older than 30 days';


    // public function handle()
    // {
    //     // $deleted = Trash::where('created_at', '<', Carbon::now()->subDays(183))->delete(); // 6 bulan
    //     $deleted = Trash::where('created_at', '<', Carbon::now()->subDays(30))->delete(); // 30 hari

    //     $this->info("Deleted $deleted old records from Trash.");
    // }

    public function handle()
    {
        // // Soft delete data yang lebih dari 30 hari
        // $softDeleteCount = Trash::whereNull('deleted_at')
        //     ->where('created_at', '<', now()->subDays(30))
        //     ->delete();

        // // Force delete data yang sudah soft deleted lebih dari 60 hari
        // $forceDeleteCount = Trash::onlyTrashed()
        //     ->where('deleted_at', '<', now()->subDays(60))
        //     ->forceDelete();

        // $this->info("Soft deleted $softDeleteCount records older than 30 days.");
        // $this->info("Permanently deleted $forceDeleteCount records older than 60 days.");
    }
}
