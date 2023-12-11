<?php

namespace Modules\Author\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Author\Entities\Author;

class AuthorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Author::truncate();
        Author::create([
            'name' => 'Arthur Conan Doyle',
            'description' => 'Detective',
            'image' => 'default image'

        ]);
        Author::create([
            'name' => 'Jules Verne',
            'description' => 'Adventure',
            'image' => 'default image'
        ]);
        Author::create([
            'name' => 'Agatha Christie',
            'description' => 'Detective',
            'image' => 'default image'
        ]);
        // $this->call("OthersTableSeeder");
    }
}
