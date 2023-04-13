<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'name' => 'administrator',
            'guard_name' => 'web',
        ]);

        $admin_user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $admin_user->assignRole('administrator');

        for ($i = 0; $i < 50; $i++) {
            $company = Company::create([
                'name' => fake()->company(),
                'email' => fake()->unique()->safeEmail(),
                'website' => fake()->domainName(),
            ]);

            Employee::create([
                'first_name' => fake()->name(),
                'last_name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'company_id' => $company->id,
            ]);
        }

    }
}
