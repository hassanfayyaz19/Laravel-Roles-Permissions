<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'Auther',
            'slug'=>'auther',
            'permissions'=>json_encode([
                'create-post'=>true,
            ])
        ]);
        Role::create([
            'name'=>'Editor',
            'slug'=>'editor',
            'permissions'=>json_encode([
                'update-post'=>true,
                'publish-post'=>true,
            ])
        ]);
        DB::table('permissions')->insert([
            ['name'=>"create-post","slug"=>"create-post"],
            ['name'=>"update-post","slug"=>"update-post"],
            ['name'=>"publish-post","slug"=>"publish-post"],
        ]);

    }
}
