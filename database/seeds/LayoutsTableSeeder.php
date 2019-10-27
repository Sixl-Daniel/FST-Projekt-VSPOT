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
            ['name' => 'Test'],
            ['name' => 'Basic'],
        ];

        foreach ($layouts as $layout) {
            Layout::updateOrCreate($layout);
        }
    }
}
