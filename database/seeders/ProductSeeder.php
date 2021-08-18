<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(['title' =>'測試產品01' , 'content' => '測試產品描述' , 'price' => rand(0,300) , 'quantity' => 20]);
        Product::create(['title' =>'測試產品02' , 'content' => '測試產品描述' , 'price' => rand(0,300) , 'quantity' => 20]);
        Product::upsert([
            ['id' =>'3' ,'title' =>'固定產品03' , 'content' => '固定產品描述' , 'price' => rand(0,300) , 'quantity' => 10],
            ['id' =>'4' ,'title' =>'固定產品04' , 'content' => '固定產品描述' , 'price' => rand(0,300) , 'quantity' => 10]
        ], ['id'],['price' ,'quantity']);
    }
}
