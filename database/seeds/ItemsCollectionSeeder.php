<?php

use Illuminate\Database\Seeder;

class ItemsCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\Item::class, 10)->create();
    }
}
