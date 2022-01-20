<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->run = "12345678";
        $user->dv = '9';
        $user->name = "Administrador";
        $user->email = "adiaz@pronova.cl";
        $user->password = bcrypt('admin');
        $user->laboratory_id = 1;
        $user->save();
        $user->givePermissionTo(Permission::all());

        //añado establecimientos de la regíon metropolitana
        $establishments = \App\Establishment::whereIn('commune_id',getCommunes())->pluck('id');
        $user->establishments()->attach($establishments);

        //añado un director al primer laboratorio
        $laboratory = \App\Laboratory::first();
        $laboratory->director_id = $user->id;
        $laboratory->save;
    }
}
