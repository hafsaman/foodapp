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
         'region_id'=>'31',
            'region' => 'Haute Garonne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'32',
            'region' => 'Gers',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'33',
            'region' => 'Gironde',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'34',
            'region' => 'Hérault',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'35',
            'region' => 'Ille-et-Vilaine',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'36',
            'region' => 'Indre',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'37',
            'region' => 'Indre-et-Loire',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'38',
            'region' => 'Isère',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'39',
            'region' => 'Jura',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'40',
            'region' => 'Landes',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'41',
            'region' => 'Loir-et-Cher',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'42',
            'region' => 'Loire',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'43',
            'region' => 'Haute Loire',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'44',
            'region' => 'Loire Atlantique',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'45',
            'region' => 'Loiret',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'46',
            'region' => 'Lot',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'47',
            'region' => 'Lot-et-Garonne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'48',
            'region' => 'Lozère',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'49',
            'region' => 'Maine-et-Loire',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'50',
            'region' => 'Manche',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'51',
            'region' => 'Marne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'52',
            'region' => 'Haute Marne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'53',
            'region' => 'Mayenne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'54',
            'region' => 'Meurthe-et-Moselle',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'55',
            'region' => 'Meuse',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'56',
            'region' => 'Morbihan',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'57',
            'region' => 'Moselle',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'58',
            'region' => 'Nièvre',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'59',
            'region' => 'Nord',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'60',
            'region' => 'Oise',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'61',
            'region' => 'Orne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'62',
            'region' => 'Pas-de-Calais',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'63',
            'region' => 'Puy-de-Dôme',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'64',
            'region' => 'Pyrénées Atlantiques',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'65',
            'region' => 'Hautes Pyrénées',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'66',
            'region' => 'Pyrénées Orientales',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'67',
            'region' => 'Bas-Rhin',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'68',
            'region' => 'Haut-Rhin',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'69',
            'region' => 'Rhône',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'70',
            'region' => 'Haute Saône',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'71',
            'region' => 'Saône-et-Loire',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'72',
            'region' => 'Sarthe',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'73',
            'region' => 'Savoie',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'74',
            'region' => 'Haute Savoie',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'75',
            'region' => 'Paris',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'76',
            'region' => 'Seine Maritime',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'77',
            'region' => 'Seine-et-Marne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'78',
            'region' => 'Yvelines',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'79',
            'region' => 'Deux-Sèvres',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'80',
            'region' => 'Somme',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'81',
            'region' => 'Tarn',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'82',
            'region' => 'Tarn-et-Garonne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'83',
            'region' => 'Var',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'84',
            'region' => 'Vaucluse',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'85',
            'region' => 'Vendée',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'86',
            'region' => 'Vienne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'87',
            'region' => 'Haute Vienne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'88',
            'region' => 'Vosges',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'89',
            'region' => 'Yonne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'90',
            'region' => 'Territoire de Belfort',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'91',
            'region' => 'Essonne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'92',
            'region' => 'Hauts-de-Seine',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'93',
            'region' => 'Seine-St-Denis',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'94',
            'region' => 'Val-de-Marne',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'95',
            'region' => 'Val-D\'Oise',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'971',
            'region' => 'Guadeloupe',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'972',
            'region' => 'Martinique',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'973',
            'region' => 'Guyane',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'974',
            'region' => 'La Réunion',
            'status' => 1
         ]);
            DB::table('region')->insert([
         'region_id'=>'976',
            'region' => 'Mayotte',
            'status' => 1
         ]);
          

    }
}
