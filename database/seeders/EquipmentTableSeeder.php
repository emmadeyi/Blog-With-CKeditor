<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment')->insert([
            [
                'user_id' => '1',
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus numquam beatae dolore repellendus eaque veritatis molestiae nulla maiores voluptates at.',
                'is_published' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'Python',
                'slug' => 'python',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus numquam beatae dolore repellendus eaque veritatis molestiae nulla maiores voluptates at.',
                'is_published' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'JavaScript',
                'slug' => 'javaScript',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus numquam beatae dolore repellendus eaque veritatis molestiae nulla maiores voluptates at.',
                'is_published' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'Django',
                'slug' => 'django',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus numquam beatae dolore repellendus eaque veritatis molestiae nulla maiores voluptates at.',
                'is_published' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => '1',
                'name' => 'ReactJs',
                'slug' => 'reactjs',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus numquam beatae dolore repellendus eaque veritatis molestiae nulla maiores voluptates at.',
                'is_published' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
