<?php

namespace App\Console\Commands;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\RoomTypesTableSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitialitionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding admin...');
        $bar = $this->getOutput()->createProgressBar(1);
        $bar->start();

        Artisan::call('migrate:fresh');
        $this->info(Artisan::output());
        $bar->advance();

        $this->warn('Seeding Admin');
        Artisan::call('db:seed', ['class' => AdminSeeder::class]);
        $this->info(Artisan::output());
        $bar->advance();

        $this->warn('Seeding Room types');
        Artisan::call('db:seed', ['class' => RoomTypesTableSeeder::class]);
        $this->info(Artisan::output());
        $bar->advance();

        $bar->finish();

        $this->comment('');
        $this->newLine();

        $this->comment('Demo admin credentials');
        $this->newLine();

        $users = User::get()->pluck('email')->map(function ($email) {
            return [
                $email,
                'admin',
            ];
        });
        $this->table(
            ['Email', 'Password'],
            $users
        );
    }
}
