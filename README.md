## Laravel Module based migration Commands

* php artisan make:migration **_~~create_products_table~~_** --path=app/Modules/**_~~Product~~_**/Database/Migrations
* php artisan migrate --path="app/Modules/**_~~Product~~_**/Database/Migrations"

## Laravel Module based Seeder Commands

Laravel's make:seeder command does not support the ```--path``` option. 
Instead, you should manually move the seeder file after creating it. Follow these steps:

**Step 1: Create the Seeder**

Run:
```
php artisan make:seeder LeadStatusSeeder
```
This will create the seeder in:
```
database/seeders/LeadStatusSeeder.php
```
**Step 2: Move the Seeder to Your Module**

Manually move the LeadStatusSeeder.php file to:
```
app/Modules/LeadStatus/Database/Seeders/
```
**Step 3: Update Namespace**

Open ```app/Modules/LeadStatus/Database/Seeders/LeadStatusSeeder.php``` and update the namespace:
```
<?php

namespace App\Modules\LeadStatus\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lead_statuses')->insert([
            ['name' => 'New', 'color' => '#ff0000', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Contacted', 'color' => '#00ff00', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Qualified', 'color' => '#0000ff', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lost', 'color' => '#ff9900', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
```
**Step 4: Register Seeder in the Module**

Open ```app/Modules/LeadStatus/Database/Seeders/DatabaseSeeder.php``` and update it:
```
<?php

namespace App\Modules\LeadStatus\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(LeadStatusSeeder::class);
    }
}
```
**Step 5: Run the Seeder**

Now, run the seeder with:
```
php artisan db:seed --class="App\Modules\LeadStatus\Database\Seeders\LeadStatusSeeder"
```
Or, if using DatabaseSeeder.php:
```
php artisan db:seed --class="App\Modules\LeadStatus\Database\Seeders\DatabaseSeeder"
```
✅ Done! 🎉
Now your lead_statuses table will be populated with dummy data. 🚀
