<?php

use Illuminate\Database\Seeder;
use App\Laboratory;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lab = new Laboratory();
        $lab->name = 'ÚNICO';
        $lab->alias = 'ÚNICO';
        $lab->external = 0;
        $lab->minsal_ws = 1;
        $lab->token_ws = "AK026-88QV-000QAQQCI-000000B8EJTK";
        $lab->pdf_generate = 0;
        $lab->cod_deis = "102100";
        $lab->commune_id = 90;
        $lab->save();

        $lab = new Laboratory();
        $lab->name = 'Externo';
        $lab->alias = 'Externo';
        $lab->external = 1;
        $lab->minsal_ws = 0;
        $lab->token_ws = NULL;
        $lab->pdf_generate = 0;
        $lab->cod_deis = NULL;
        $lab->commune_id = 90;
        $lab->save();
    }
}
