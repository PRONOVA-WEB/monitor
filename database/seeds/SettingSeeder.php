<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();

        \DB::table('settings')->insert(array(
            0 =>
            array(
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Título del sitio',
                'value' => 'Monitor Covid',
                'details' => '',
                'type' => 'text',
                'order' => 1,
            ),
            1 =>
            array(
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Descripción del sitio',
                'value' => '<p>Sistema para la gestión de casos <strong>COVID-19</strong> por parte de laboratorios, con su posterior seguimiento y levantamiento de avisos y eventos. Cuenta con geolocalizaci&oacute;n de casos, adem&aacute;s de asignaci&oacute;n de residencias sanitarias para pacientes.</p>',
                'details' => '',
                'type' => 'rich_text_box',
                'order' => 2,
            ),
            2 =>
            array(
                'id' => 3,
                'key' => 'site.logo',
                'display_name' => 'Logo del sitio',
                'value' => '/images/logo_pronova.jpg',
                'details' => '',
                'type' => 'image',
                'order' => 4,
            )
        ));
    }
}
