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
            ],
            [
                'name' => 'Considering',
            ],
            [
                'name' => 'In Progress',
            ],
            [
                'name' => 'Implemented',
            ],
            [
                'name' => 'Closed',
            ]
        ]);
    }
}
