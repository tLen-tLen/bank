<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 *
 * @package Database\Seeders
 */
class CurrenciesAndCoursesData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            ['name' => 'USD'],
            ['name' => 'EUR'],
            ['name' => 'RUB']
        ]);

        DB::table('courses')->insert([
            [
                'currency_from_id' => Currency::where(['name' => 'USD'])->first()->id,
                'currency_to_id' => Currency::where(['name' => 'RUB'])->first()->id,
                'amount' => 70
            ],
            [
                'currency_from_id' => Currency::where(['name' => 'EUR'])->first()->id,
                'currency_to_id' => Currency::where(['name' => 'RUB'])->first()->id,
                'amount' => 80
            ],
            [
                'currency_from_id' => Currency::where(['name' => 'EUR'])->first()->id,
                'currency_to_id' => Currency::where(['name' => 'USD'])->first()->id,
                'amount' => 1
            ],
        ]);
    }
}
