<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('votes')->delete();
        DB::table('specials')->delete();
        DB::table('bar_features')->delete();
        DB::table('bar_pictures')->delete();
        DB::table('events')->delete();
        DB::table('reviews')->delete();
        DB::table('bars')->delete();
        DB::table('users')->delete();
        $this->call(UsersTableSeeder::class);
        $this->call(BarsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
//        $this->call(BarPicturesTableSeeder::class);
        $this->call(BarFeaturesTableSeeder::class);
        $this->call(SpecialsTableSeeder::class);
        $this->call(VotesTableSeeder::class);

        Model::reguard();
    }
}
