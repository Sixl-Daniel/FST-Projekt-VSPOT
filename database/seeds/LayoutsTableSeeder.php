<?php

use App\Layout;
use Illuminate\Database\Seeder;

class LayoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $layouts = [
            ['name' => 'Demo'],
            ['name' => 'Basic'],
            ['name' => 'Advanced'],
            ['name' => 'Pro']
        ];

        foreach ($layouts as $layout) {
            Layout::updateOrCreate($layout);
        }
    }
}
