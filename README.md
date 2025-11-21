<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalasi
- jalankan `composer install` setelah melakukan clone dari github
- composer update
- copy .env.example .env if .env not exists
- configuration database in file .env
- php artisan key:generate
- php artisan migrate:rollback
- php artisan migrate:refresh --seed

## Setup 

1. Buat database pada php myadmin sesuai dengan nama database
2. Import database `db_simpel.sql`
3. Untuk password yang ada di tabel users

compose
## hapus data otomatis 
php artisan make:command DeleteOldRecords
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
crontab -e

Tes manual
php artisan records:cleanup

mengunakan model

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi; // ganti sesuai nama modelmu
use Carbon\Carbon;

class DeleteOldRecords extends Command
{
    protected $signature = 'records:cleanup';
    protected $description = 'Delete Transaksi records older than 30 days';

    public function handle()
    {
        $deleted = Transaksi::where('created_at', '<', Carbon::now()->subDays(30))->delete();

        $this->info("Deleted $deleted old records from Transaksi.");
    }
}

protected function schedule(Schedule $schedule)
{
    $schedule->command('records:cleanup')->daily(); // Jalan tiap hari
}


php artisan records:cleanup

Kas::where('created_at', '<', now()->subDays(30))->delete();
Log::where('created_at', '<', now()->subDays(30))->delete();

