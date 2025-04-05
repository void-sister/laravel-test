<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $numOfDomains = rand(1, 3);

            for ($i = 0; $i < $numOfDomains; $i++) {
                Domain::create([
                    'user_id' => $user->id,
                    'domain' => Str::random(5) . '.com',
                    'created_at' => Carbon::now()->subDays(rand(0, 30)),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
