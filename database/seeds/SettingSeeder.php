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
                'value' => '<h2>What is Lorem Ipsum?</h2>
                <p><strong>Lorem Ipsum</strong>&nbsp;</p>
                <p>Is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
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
