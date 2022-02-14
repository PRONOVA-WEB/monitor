<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MinciProducto1Std;
use App\MinciProducto5std;

class MinciCovidCases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minci:covidcases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate minci_producto1_std,minci_producto5_std  tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', '360');

        $producto1 = 'https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto1/Covid-19_std.csv'; // casos acumulados por comuna
        $producto5 = 'https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto5/TotalesNacionales_std.csv'; // totales nacionales

        //producto1
        $casos1 = [];
        if (($open = fopen($producto1, "r")) !== FALSE) {
            \DB::table('minci_producto1_std')->delete();
            while (($data = fgetcsv($open, 0, ",")) !== FALSE) {
                $casos1[] = $data;
            }

            fclose($open);
        }

        foreach (array_slice($casos1, 1) as $item) {

            if($item[5] >= \Carbon\Carbon::now()->subDays(30)->toDateString()) {
                MinciProducto1Std::create(
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

        //tabla producto5
        $casos5 = [];
        if (($open = fopen($producto5, "r")) !== FALSE) {
            \DB::table('minci_producto5_std')->delete();
            while (($data = fgetcsv($open, 0, ",")) !== FALSE) {
                $casos5[] = $data;
            }

            fclose($open);
        }

        foreach (array_slice($casos5, 1) as $item) {

            if($item[1] >= \Carbon\Carbon::now()->subDays(3)->toDateString()) {
                MinciProducto5std::create(
                    [
                    'item' => $item[0],
                    'date' => $item[1],
                    'total' => $item[2]
                    ]
                );
            }

        }
    }
}
