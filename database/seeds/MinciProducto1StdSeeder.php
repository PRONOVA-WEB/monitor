<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MinciProducto1StdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', '360');

        $casos = [];

        if (($open = fopen('https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto1/Covid-19_std.csv', "r")) !== FALSE) {

            while (($data = fgetcsv($open, 0, ",")) !== FALSE) {
                $casos[] = $data;
            }

            fclose($open);
        }

        // echo "<pre>";
        // dd(array_slice($casos, 1));
        \DB::table('minci_producto1_std')->delete();

        foreach (array_slice($casos, 1) as $item) {
            \App\MinciProducto1Std::create(
                [
                'region' => $item[0],
                'region_code' => $item[1],
                'commune' => $item[2],
                'commune_code' => $item[3],
                'population' => $item[4],
                'date' => $item[5],
                'commit_cases' => $item[6]
                ]
            );
        }
    }
}
