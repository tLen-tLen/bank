<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Данные для тестирования
 * @package Database\Seeders
 */
class TestData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            'name' => 'Bank name'
        ]);

        DB::table('clients')->insert([
            'name' => 'Client name test',
            'phone' => '89964424151',
            'email' => 'lastonetwo18@gmail.com',
        ]);
    }
}
