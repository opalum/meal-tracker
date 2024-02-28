<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->where('name', 'Admin')
                                         ->first()
                                         ->id;
        $dinerRoleId = DB::table('roles')->where('name', 'Comensal')
                                         ->first()->id;


        $users = [
            [
                'identity' => 'admin',
                'name'     => 'Admin',
                'role_id'  => $adminRoleId,
                'password' => 'tesseract'
            ],
            [
                'identity' => '1102815675',
                'rank'     => 'TCRN',
                'name'     => 'LUDEÑA BUSTAN JUAN CARLOS',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0401393152',
                'rank'     => 'MAYO',
                'name'     => 'GONZALEZ LARA PABLO DAVID',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1716863913',
                'rank'     => 'CAPT',
                'name'     => 'VASQUEZ MONCAYO TATIANA PAOLA',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0604120592',
                'rank'     => 'CAPT',
                'name'     => 'BARROS TENELEMA JUAN CARLOS',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1718314915',
                'rank'     => 'TNTE',
                'name'     => 'GUALOTO HIDALGO JUAN EDUARDO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0604532465',
                'rank'     => 'TNTE',
                'name'     => 'MOYOTA MORA DANIELA CRISTINA',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1718528290',
                'rank'     => 'SUBT',
                'name'     => 'VEINTIMILLA PONCE OSWALDO RODRIGO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0603995077',
                'rank'     => 'SUBT',
                'name'     => 'GUARANGA CALDERÓN EDISON XAVIER',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0301253712',
                'rank'     => 'SUBP',
                'name'     => 'OCHOA PADILLA WILSON',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0602485971',
                'rank'     => 'SUBP',
                'name'     => 'SEGURA RODRIGUEZ JORGE SANDRO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1713261459',
                'rank'     => 'SUBP',
                'name'     => 'FLORES BENALCAZAR LUIS ARMANDO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1802938447',
                'rank'     => 'SGOP',
                'name'     => 'SANCHEZ MASAQUIZA CLAUDIO RAMIRO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1002007621',
                'rank'     => 'SGOP',
                'name'     => 'RODRIGUEZ GUERRA JAIME LEONARDO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1802652477',
                'rank'     => 'SGOP',
                'name'     => 'GUEVARA HARO JUAN CARLOS',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0603034646',
                'rank'     => 'SGOP',
                'name'     => 'COLCHA SANI GERMAN PATRICIO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1715947022',
                'rank'     => 'SGOP',
                'name'     => 'SOTO PAGUAY DIEGO JAVIER',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1802948685',
                'rank'     => 'SGOP',
                'name'     => 'CUNALATA CHANGO WASHINTON NEPTALI',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1714043732',
                'rank'     => 'SGOS',
                'name'     => 'CAMPOVERDE HURTADO CARLOS ALBERTO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1002883310',
                'rank'     => 'SGOS',
                'name'     => 'ANRANGO ANTAMBA LUIS EDISON',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1718531831',
                'rank'     => 'SGOS',
                'name'     => 'CADENA CAÑAR LARRY VICENTE',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0502525249',
                'rank'     => 'SGOS',
                'name'     => 'JAMI VACA LUIS PATRICIO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0602911463',
                'rank'     => 'SGOS',
                'name'     => 'AMAGUAYA CAJO BYRON DANILO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0704105493',
                'rank'     => 'SGOS',
                'name'     => 'NIVICELA CRUZ STALIN JOSE',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1003235833',
                'rank'     => 'SGOS',
                'name'     => 'CHUMA IPIALES PABLO RUBEN',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0923038798',
                'rank'     => 'SGOS',
                'name'     => 'CALDERON ALVARADO JIMMY RICARDO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0920984614',
                'rank'     => 'SGOS',
                'name'     => 'HIDALGO ALZAMORA WILMER ANDRES',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1718449323',
                'rank'     => 'CBOP',
                'name'     => 'CHIMBA PICHUCHO DIEGO PAUL',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0502831589',
                'rank'     => 'CBOP',
                'name'     => 'ZAMBRANO ROSERO ALEX PAUL',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0705008993',
                'rank'     => 'CBOP',
                'name'     => 'MAZA MONCADA KLEVER GERMAN',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1804276432',
                'rank'     => 'CBOP',
                'name'     => 'CAMPAÑA ALVAREZ DARWIN MAURICIO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0401580766',
                'rank'     => 'CBOP',
                'name'     => 'QUISHPI PEREZ FAUSTO ANTONIO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0704209519',
                'rank'     => 'CBOP',
                'name'     => 'MONTALVAN LALANGUI JORGE ANTONIO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0603829474',
                'rank'     => 'CBOP',
                'name'     => 'LOPEZ CUZCO DIEGO PAUL',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1718471392',
                'rank'     => 'CBOP',
                'name'     => 'RAMOS GALEAS ULISES VLADIMIR',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0502888837',
                'rank'     => 'CBOP',
                'name'     => 'GUANOPATIN VILLALBA VICENTE DAVID',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1723109045',
                'rank'     => 'CBOP',
                'name'     => 'MACIAS JIMENEZ DARWIN ESTALIN',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0503024689',
                'rank'     => 'CBOP',
                'name'     => 'YUGCHA PILATASIG HENRY SALVADOR',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '1718432832',
                'rank'     => 'SLDO',
                'name'     => 'BAUTISTA CASTILLO JEFFERSON FERNANDO',
                'role_id'  => $dinerRoleId,
            ],

            [
                'identity' => '0604621268',
                'rank'     => 'SLDO',
                'name'     => 'URQUIZO AGUIAR LUIS DAVID',
                'role_id'  => $dinerRoleId,
            ],

        ];

        foreach ($users as $user) {
            $userExists = DB::table('users')->where('identity', $user['identity'])
                                            ->exists();

            if (!$userExists) {
                DB::table('users')->insert([
                    'identity'   => $user['identity'],
                    'name'       => $user['name'],
                    'email'      => $user['identity'] . '@agrucomge.com',
                    'phone'      => '',
                    'role_id'    => $user['role_id'],
                    'password'   => Hash::make(isset($user['password']) ? $user['password'] : $user['identity']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
