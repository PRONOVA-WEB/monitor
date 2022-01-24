<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Populate minci_producto1_std table';

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

        $casos = [];

        if (($open = fopen('https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto1/Covid-19_std.csv', "r")) !== FALSE) {

            while (($data = fgetcsv($open, 0, ",")) !== FALSE) {
                $casos[] = $data;
            }

            fclose($open);
        }

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
