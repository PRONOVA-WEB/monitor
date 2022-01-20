<?php

use Illuminate\Database\Seeder;

class ResidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items = [

            ['id' => 1, 'name' => 'Hotel Santo Domingo' , 'address' => 'Santo Domingo','number'=>'1546', 'commune_id'=>'90','telephone'=> '572449287', 'width'=> '172', 'height'=> '172', 'latitude'=>'-33.436955836980395', 'longitude'=>'-70.6590826468289'],
        ];

        foreach ($items as $item) {
            \App\SanitaryResidence\Residence::create($item);
        }
    }
}
