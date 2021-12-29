<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria = array(
            array('id' => '2','name' => 'Harga','weight' => '80'),
            array('id' => '3','name' => 'Wisata','weight' => '70'),
            array('id' => '4','name' => 'Durasi','weight' => '50'),
            array('id' => '5','name' => 'Fasilitas','weight' => '60')
        );

        DB::table('criteria')->insert($criteria);

        $alternative_criteria = array(
            array('id' => '2','alternative_id' => '2','criteria_id' => '2','score' => '80'),
            array('id' => '3','alternative_id' => '2','criteria_id' => '3','score' => '70'),
            array('id' => '4','alternative_id' => '2','criteria_id' => '4','score' => '75'),
            array('id' => '5','alternative_id' => '2','criteria_id' => '5','score' => '60'),
            array('id' => '6','alternative_id' => '3','criteria_id' => '2','score' => '60'),
            array('id' => '7','alternative_id' => '3','criteria_id' => '3','score' => '75'),
            array('id' => '8','alternative_id' => '3','criteria_id' => '4','score' => '60'),
            array('id' => '9','alternative_id' => '3','criteria_id' => '5','score' => '80'),
            array('id' => '10','alternative_id' => '4','criteria_id' => '2','score' => '95'),
            array('id' => '11','alternative_id' => '4','criteria_id' => '3','score' => '75'),
            array('id' => '12','alternative_id' => '4','criteria_id' => '4','score' => '70'),
            array('id' => '13','alternative_id' => '4','criteria_id' => '5','score' => '80'),
            array('id' => '14','alternative_id' => '5','criteria_id' => '2','score' => '70'),
            array('id' => '15','alternative_id' => '5','criteria_id' => '3','score' => '90'),
            array('id' => '16','alternative_id' => '5','criteria_id' => '4','score' => '75'),
            array('id' => '17','alternative_id' => '5','criteria_id' => '5','score' => '85')
        );

        DB::table('alternative_criteria')->insert($alternative_criteria);
    }
}
