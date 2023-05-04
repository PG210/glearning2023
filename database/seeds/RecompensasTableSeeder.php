<?php

use Illuminate\Database\Seeder;

class RecompensasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('gifts')->insert([
            ['name' => 'MEMOREX ACC01.', 'imagen' => 'storage/MEMOREX_ACC01.png', 'avatarchange' => 'storage/SELEC-MEMOREX-H-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '1'],
            ['name' => 'MEMOREX ACC02.', 'imagen' => 'storage/MEMOREX_ACC02.png', 'avatarchange' => 'storage/SELEC-MEMOREX-H-001.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '1'],
            ['name' => 'MEMOREX ACC03.', 'imagen' => 'storage/MEMOREX_ACC03.png', 'avatarchange' => 'storage/SELEC-MEMOREX-H.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '1'],
            
            ['name' => 'LINGUO ACC01.', 'imagen' => 'storage/LINGUO_ACC01.png', 'avatarchange' => 'storage/SELEC-LINGUO-H-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '2'],
            ['name' => 'LINGUO ACC02.', 'imagen' => 'storage/LINGUO_ACC02.png', 'avatarchange' => 'storage/SELEC-LINGUO-H-001.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '2'],
            ['name' => 'LINGUO ACC03.', 'imagen' => 'storage/LINGUO_ACC03.png', 'avatarchange' => 'storage/SELEC-LINGUO-H.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '2'],
            
            ['name' => 'MARKER ACC01.', 'imagen' => 'storage/MARKER_ACC01.png', 'avatarchange' => 'storage/SELEC-MARKER-H-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '3'],
            ['name' => 'MARKER ACC02.', 'imagen' => 'storage/MARKER_ACC02.png', 'avatarchange' => 'storage/SELEC-MARKER-H-003.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '3'],
            ['name' => 'MARKER ACC03.', 'imagen' => 'storage/MARKER_ACC03.png', 'avatarchange' => 'storage/SELEC-MARKER-H.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '3'],

            ['name' => 'SABIUS ACC01.', 'imagen' => 'storage/SABIUS_ACC01.png', 'avatarchange' => 'storage/SELEC-SABIUS-H-001.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '4'],
            ['name' => 'SABIUS ACC02.', 'imagen' => 'storage/SABIUS_ACC02.png', 'avatarchange' => 'storage/SELEC-SABIUS-H-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '4'],
            ['name' => 'SABIUS ACC03.', 'imagen' => 'storage/SABIUS_ACC03.png', 'avatarchange' => 'storage/SELEC-SABIUS-H.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '4'],


            ['name' => 'MEMOREX ACC01.', 'imagen' => 'storage/MEMOREX_ACC01.png', 'avatarchange' => 'storage/SELEC-MEMOREX-M-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '5'],
            ['name' => 'MEMOREX ACC02.', 'imagen' => 'storage/MEMOREX_ACC02.png', 'avatarchange' => 'storage/SELEC-MEMOREX-M-001.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '5'],
            ['name' => 'MEMOREX ACC03.', 'imagen' => 'storage/MEMOREX_ACC03.png', 'avatarchange' => 'storage/SELEC-MEMOREX-M.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '5'],
            
            ['name' => 'LINGUO ACC01.', 'imagen' => 'storage/LINGUO_ACC01.png', 'avatarchange' => 'storage/SELEC-LINGUO-M-001.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '6'],
            ['name' => 'LINGUO ACC02.', 'imagen' => 'storage/LINGUO_ACC02.png', 'avatarchange' => 'storage/SELEC-LINGUO-M-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '6'],
            ['name' => 'LINGUO ACC03.', 'imagen' => 'storage/LINGUO_ACC03.png', 'avatarchange' => 'storage/SELEC-LINGUO-M.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '6'],
            
            ['name' => 'MARKER ACC01.', 'imagen' => 'storage/MARKER_ACC01.png', 'avatarchange' => 'storage/SELEC-MARKER-M-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '7'],
            ['name' => 'MARKER ACC02.', 'imagen' => 'storage/MARKER_ACC02.png', 'avatarchange' => 'storage/SELEC-MARKER-M-003.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '7'],
            ['name' => 'MARKER ACC03.', 'imagen' => 'storage/MARKER_ACC03.png', 'avatarchange' => 'storage/SELEC-MARKER-M.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '7'],

            ['name' => 'SABIUS ACC01.', 'imagen' => 'storage/SABIUS_ACC01.png', 'avatarchange' => 'storage/SELEC-SABIUS-M-001.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '8'],
            ['name' => 'SABIUS ACC02.', 'imagen' => 'storage/SABIUS_ACC02.png', 'avatarchange' => 'storage/SELEC-SABIUS-M-002.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '8'],
            ['name' => 'SABIUS ACC03.', 'imagen' => 'storage/SABIUS_ACC03.png', 'avatarchange' => 'storage/SELEC-SABIUS-M.jpg', 's_point' => '10', 'i_point' => '10', 'g_point' => '10', 'description' => 'edite la descripcion', 'avatar_id' => '8'],

        ]);
    }
}
