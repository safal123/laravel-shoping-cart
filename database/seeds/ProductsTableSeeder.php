<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->insert([
        //   'categroy_id' => 1,
        //   'name' => Str::random(10),
        //   'description' => Str::random(20),
        //   'price' => 20.00,
        //   'discount' => 13.00
        // ]);

        factory(App\Product::class, 20)->create();
    }
}
