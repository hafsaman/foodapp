<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('region')->insert([
        	'region_id'=>'01',
            'region' => 'Ain',
            'status' => 1
         ]);
         DB::table('region')->insert([
        	'region_id'=>'02',
            'region' => 'Aisne',
            'status' => 1
         ]);
          DB::table('region')->insert([
        	'region_id'=>'03',
            'region' => 'Allier',
            'status' => 1
         ]);
           DB::table('region')->insert([
        	'region_id'=>'04',
            'region' => 'Alpes-de-Haute-Provence',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'05',
            'region' => 'Hautes-Alpes',
            'status' => 1
         ]);
             DB::table('region')->insert([
        	'region_id'=>'06',
            'region' => 'Alpes Maritimes',
            'status' => 1
         ]);
              DB::table('region')->insert([
        	'region_id'=>'07',
            'region' => 'Ardèche',
            'status' => 1
         ]);
               DB::table('region')->insert([
        	'region_id'=>'08',
            'region' => 'Ardennes',
            'status' => 1
         ]);
                DB::table('region')->insert([
        	'region_id'=>'09',
            'region' => 'Ariège',
            'status' => 1
         ]);
                 DB::table('region')->insert([
        	'region_id'=>'10',
            'region' => 'Aube',
            'status' => 1
         ]);
                  DB::table('region')->insert([
        	'region_id'=>'11',
            'region' => 'Aude',
            'status' => 1
         ]);
                   DB::table('region')->insert([
        	'region_id'=>'12',
            'region' => 'Aveyron',
            'status' => 1
         ]);
                    DB::table('region')->insert([
        	'region_id'=>'13',
            'region' => 'Bouches-du-Rhône',
            'status' => 1
         ]);
                     DB::table('region')->insert([
        	'region_id'=>'14',
            'region' => 'Calvados',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'15',
            'region' => 'Cantal',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'16',
            'region' => 'Charente',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'17',
            'region' => 'Charente-Maritime',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'18',
            'region' => 'Cher',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'19',
            'region' => 'Corrèze',
            'status' => 1
         ]);
            
            DB::table('region')->insert([
        	'region_id'=>'2A',
            'region' => 'Corse-du-Sud',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'2B',
            'region' => 'Haute Corse',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'21',
            'region' => 'Côte-d’Or',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'22',
            'region' => 'Côtes d Armor',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'23',
            'region' => 'Creuse',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'24',
            'region' => 'Dordogne',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'25',
            'region' => 'Doubs',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'26',
            'region' => 'Drôme',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'27',
            'region' => 'Eure',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'28',
            'region' => 'Eure-et-Loir',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'29',
            'region' => 'Finistère',
            'status' => 1
         ]);
            DB::table('region')->insert([
        	'region_id'=>'30',
            'region' => 'Gard',
            'status' => 1
         ]);
         


    }
}
