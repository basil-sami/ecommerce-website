<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Truncate all the tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate all the tables
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('product_views')->truncate();
        DB::table('sessions')->truncate();
        DB::table('users')->truncate();
        DB::table('products')->truncate();
        DB::table('companies')->truncate();
        DB::table('categories')->truncate();
        DB::table('cache_locks')->truncate();
        DB::table('cache')->truncate();
        DB::table('admins')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed the tables with new data
        DB::table('admins')->insert($this->generateAdminsData());
        DB::table('cache')->insert($this->generateCacheData());
        DB::table('cache_locks')->insert($this->generateCacheLocksData());
        DB::table('categories')->insert($this->generateCategoriesData());
        DB::table('companies')->insert($this->generateCompaniesData());
        DB::table('products')->insert($this->generateProductsData());
        DB::table('users')->insert($this->generateUsersData());
        DB::table('orders')->insert($this->generateOrdersData());
        DB::table('order_items')->insert($this->generateOrderItemsData());
        DB::table('product_views')->insert($this->generateProductViewsData());
        DB::table('sessions')->insert($this->generateSessionsData());
    }

    private function generateAdminsData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => "Admin $i",
                'email' => "admin$i@example.com",
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }

    private function generateCacheData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'key' => "cache_key_$i",
                'value' => Str::random(50),
                'expiration' => now()->addDays(rand(1, 30))->timestamp,
            ];
        }
        return $data;
    }

    private function generateCacheLocksData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'key' => "cache_lock_key_$i",
                'owner' => Str::random(10),
                'expiration' => now()->addDays(rand(1, 30))->timestamp,
            ];
        }
        return $data;
    }

    private function generateCategoriesData()
    {
        $data = [];
        $categories = ['Electronics', 'Books', 'Clothing', 'Home & Kitchen', 'Sports', 'Toys', 'Health', 'Beauty', 'Automotive', 'Garden'];
        foreach ($categories as $category) {
            $data[] = [
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }

    private function generateCompaniesData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => "Company $i",
                'address' => "123 Main St, City $i",
                'email' => "company$i@example.com",
                'phone' => "555-1234$i",
                'website' => "www.company$i.com",
                'description' => "This is a description for Company $i.",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }

    private function generateProductsData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'category_id' => rand(1, 10),
                'name' => "Product $i",
                'description' => "This is the description for Product $i.",
                'price' => rand(10, 100),
                'quantity' => rand(1, 50),
                'image_path' => "images/product$i.jpg",
                'created_at' => now(),
                'updated_at' => now(),
                'company_id' => rand(1, 10),
                'views' => rand(0, 100),
                'searches' => rand(0, 50),
                'purchases' => rand(0, 20),
            ];
        }
        return $data;
    }

    private function generateUsersData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'email_verified' => rand(0, 1),
                'verification_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }

    private function generateOrdersData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'user_id' => rand(1, 10),
                'total' => rand(50, 500),
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $data;
    }

    private function generateOrderItemsData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'product_id' => rand(1, 10),
                'quantity' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
                'total_amount' => rand(10, 100),
                'user_id' => rand(1, 10),
                'status' => 'shipped',
            ];
        }
        return $data;
    }

    private function generateProductViewsData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'user_id' => rand(1, 10),
                'product_id' => rand(1, 10),
                'category_id' => rand(1, 10),
                'created_at' => now(),
            ];
        }
        return $data;
    }

    private function generateSessionsData()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'id' => Str::uuid(),
                'user_id' => rand(1, 10),
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'payload' => Str::random(100),
                'last_activity' => now()->timestamp,
            ];
        }
        return $data;
    }
}
