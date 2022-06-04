<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class  StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Status::query()->insert([
            [
                'name' => 'Open',
                'class' => 'bg-gray-300'
            ],
            [
                'name' => 'Considering',
                'class' => 'bg-purple text-white'
            ],
            [
                'name' => 'In Progress',
                'class' => 'bg-yellow text-white'
            ],
            [
                'name' => 'Implemented',
                'class' => 'bg-green text-white'
            ],
            [
                'name' => 'Close',
                'class' => 'bg-red text-white'
            ]
        ]);
    }
}
