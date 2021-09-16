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
            'status' => 1,
            'latitude' => '24.222651',
            'longitude' => '55.765099',
         ]);
            DB::table('region')->insert([
         'region_id'=>'02',
            'region' => 'Aisne',
            'status' => 1,
            'latitude' => '49.410469',
            'longitude' => '3.516930',
         ]);
            DB::table('region')->insert([
         'region_id'=>'03',
            'region' => 'Allier',
            'status' => 1,
            'latitude' => '46.117229',
            'longitude' => '3.402640',
         ]);
            DB::table('region')->insert([
         'region_id'=>'04',
            'region' => 'Alpes-de-Haute-Provence',
            'status' => 1,
            'latitude' => '44.164188',
            'longitude' => '6.232930',
         ]);
            DB::table('region')->insert([
         'region_id'=>'05',
            'region' => 'utes-AlpesHa',
            'status' => 1,
            'latitude' => '53.379920',
            'longitude' => '49.087780',
         ]);
            DB::table('region')->insert([
         'region_id'=>'06',
            'region' => 'Alpes Maritimes',
            'status' => 1,
            'latitude' => '43.937750',
            'longitude' => '7.116700',
         ]);
            DB::table('region')->insert([
         'region_id'=>'07',
            'region' => 'Ardèche',
            'status' => 1,
            'latitude' => '44.821621',
            'longitude' => '4.429290',
         ]);
            DB::table('region')->insert([
         'region_id'=>'08',
            'region' => 'Ardennes',
            'status' => 1,
            'latitude' => '49.762463',
            'longitude' => '4.628505',
         ]);
            DB::table('region')->insert([
         'region_id'=>'09',
            'region' => 'Ariège',
            'status' => 1,
            'latitude' => '42.845100',
            'longitude' => '1.607850',
         ]);
            DB::table('region')->insert([
         'region_id'=>'10',
            'region' => 'Aube',
            'status' => 1,
            'latitude' => '48.738708',
            'longitude' => '0.545300',
         ]);
            DB::table('region')->insert([
         'region_id'=>'11',
            'region' => 'Aude',
            'status' => 1,
            'latitude' => '43.243641',
            'longitude' => '2.999460',
         ]);
            DB::table('region')->insert([
         'region_id'=>'12',
            'region' => 'Aveyron',
            'status' => 1,
            'latitude' => '44.325790',
            'longitude' => '3.059170',
         ]);
            DB::table('region')->insert([
         'region_id'=>'13',
            'region' => 'Bouches-du-Rhône',
            'status' => 1,
            'latitude' => '43.388149',
            'longitude' => '4.803220',
         ]);
            DB::table('region')->insert([
         'region_id'=>'14',
            'region' => 'Calvados',
            'status' => 1,
            'latitude' => '48.839970',
            'longitude' => '-1.048000',
         ]);
            DB::table('region')->insert([
         'region_id'=>'15',
            'region' => 'Cantal',
            'status' => 1,
            'latitude' => '49.434601',
            'longitude' => '-101.923729',
         ]);
            DB::table('region')->insert([
         'region_id'=>'16',
            'region' => 'Charente',
            'status' => 1,
            'latitude' => '45.942059',
            'longitude' => '-0.889310',
         ]);
            DB::table('region')->insert([
         'region_id'=>'17',
            'region' => 'Charente-Maritime',
            'status' => 1,
            'latitude' => '45.730389',
            'longitude' => '-0.779820',
         ]);
            DB::table('region')->insert([
         'region_id'=>'18',
            'region' => 'Cher',
            'status' => 1,
            'latitude' => '47.275471',
            'longitude' => '1.554970',
         ]);
            DB::table('region')->insert([
         'region_id'=>'19',
            'region' => 'Corrèze',
            'status' => 1,
            'latitude' => '45.277660',
            'longitude' => '11.693410',
         ]);
            DB::table('region')->insert([
         'region_id'=>'2A',
            'region' => 'Corse-du-Sud',
            'status' => 1,
            'latitude' => '41.872959',
            'longitude' => '8.973890',
         ]);
            DB::table('region',)->insert([
         'region_id'=>'2B',
            'region' => 'Haute Corse',
            'status' => 1,
            'latitude' => '42.394750',
            'longitude' => '9.206280',
         ]);
            DB::table('region')->insert([
         'region_id'=>'21',
            'region' => 'Côte-d’Or',
            'status' => 1,
            'latitude' => '38.393770',
            'longitude' => '-121.344730',
         ]);
            DB::table('region')->insert([
         'region_id'=>'22',
            'region' => 'Côtes d Armor',
            'status' => 1,
            'latitude' => '48.441020',
            'longitude' => '-2.863820',
         ]);
            DB::table('region')->insert([
         'region_id'=>'23',
            'region' => 'Creuse',
            'status' => 1,
            'latitude' => '49.839169',
            'longitude' => '2.163360',
         ]);
            DB::table('region')->insert([
         'region_id'=>'24',
            'region' => 'Dordogne',
            'status' => 1,
            'latitude' => '45.081871',
            'longitude' => '1.908520',
         ]);
            DB::table('region')->insert([
         'region_id'=>'25',
            'region' => 'Doubs',
            'status' => 1,
            'latitude' => '46.927921',
            'longitude' => '6.351110',
         ]);
            DB::table('region')->insert([
         'region_id'=>'26',
            'region' => 'Drôme',
            'status' => 1,
            'latitude' => '44.771690',
            'longitude' => '4.842170',
         ]);
            DB::table('region')->insert([
         'region_id'=>'27',
            'region' => 'Eure',
            'status' => 1,
            'latitude' => '36.426529',
            'longitude' => '-76.846222',
         ]);
            DB::table('region')->insert([
         'region_id'=>'28',
            'region' => 'Eure-et-Loir',
            'status' => 1,
            'latitude' => '48.447399',
            'longitude' => '1.374960',
         ]);
            DB::table('region')->insert([
         'region_id'=>'29',
            'region' => 'Finistère',
            'status' => 1,
            'latitude' => '48.232761',
            'longitude' => '-4.264130',
         ]);
            DB::table('region')->insert([
         'region_id'=>'30',
            'region' => 'Gard',
            'status' => 1,
            'latitude' => '43.973591',
            'longitude' => '4.688930',
         ]);
            DB::table('region')->insert([
         'region_id'=>'31',
            'region' => 'Haute Garonne',
            'status' => 1,
            'latitude' => '43.305401',
            'longitude' => '1.244670',
         ]);
            DB::table('region')->insert([
         'region_id'=>'32',
            'region' => 'Gers',
            'status' => 1,
            'latitude' => '43.903912',
            'longitude' => '0.210700',
         ]);
            DB::table('region')->insert([
         'region_id'=>'33',
            'region' => 'Gironde',
            'status' => 1,
            'latitude' => '44.849667',
            'longitude' => '-0.450237',
         ]);
            DB::table('region')->insert([
         'region_id'=>'34',
            'region' => 'Hérault',
            'status' => 1,
            'latitude' => '43.626999',
            'longitude' => '3.433890',
         ]);
            DB::table('region')->insert([
         'region_id'=>'35',
            'region' => 'Ille-et-Vilaine',
            'status' => 1,
            'latitude' => '48.562180',
            'longitude' => '-1.928120',
         ]);
            DB::table('region')->insert([
         'region_id'=>'36',
            'region' => 'Indre',
            'status' => 1,
            'latitude' => '47.199402',
            'longitude' => '-1.672550',
         ]);
            DB::table('region')->insert([
         'region_id'=>'37',
            'region' => 'Indre-et-Loire',
            'status' => 1,
            'latitude' => '47.223412',
            'longitude' => '0.709270',
         ]);
            DB::table('region')->insert([
         'region_id'=>'38',
            'region' => 'Isère',
            'status' => 1,
            'latitude' => '45.046669',
            'longitude' => '5.055470',
         ]);
            DB::table('region')->insert([
         'region_id'=>'39',
            'region' => 'Jura',
            'status' => 1,
            'latitude' => '47.519180',
            'longitude' => '29.041500',
         ]);
            DB::table('region')->insert([
         'region_id'=>'40',
            'region' => 'Landes',
            'status' => 1,
            'latitude' => '45.992630',
            'longitude' => '-0.596480',
         ]);
            DB::table('region')->insert([
         'region_id'=>'41',
            'region' => 'Loir-et-Cher',
            'status' => 1,
            'latitude' => '47.659779',
            'longitude' => '1.414150',
         ]);
            DB::table('region')->insert([
         'region_id'=>'42',
            'region' => 'Loire',
            'status' => 1,
            'latitude' => '47.614231',
            'longitude' => '-0.979230',
         ]);
            DB::table('region')->insert([
         'region_id'=>'43',
            'region' => 'Haute Loire',
            'status' => 1,
            'latitude' => '45.085979',
            'longitude' => '3.786240',
         ]);
            DB::table('region')->insert([
         'region_id'=>'44',
            'region' => 'Loire Atlantique',
            'status' => 1,
            'latitude' => '47.348000',
            'longitude' => '-1.753120',
         ]);
            DB::table('region')->insert([
         'region_id'=>'45',
            'region' => 'Loiret',
            'status' => 1,
            'latitude' => '47.913830',
            'longitude' => '2.320000',
         ]);
            DB::table('region')->insert([
         'region_id'=>'46',
            'region' => 'Lot',
            'status' => 1,
            'latitude' => '36.755569',
            'longitude' => '-95.934235',
         ]);
            DB::table('region')->insert([
         'region_id'=>'47',
            'region' => 'Lot-et-Garonne',
            'status' => 1,
            'latitude' => '44.369251',
            'longitude' => '0.468750',
         ]);
            DB::table('region')->insert([
         'region_id'=>'48',
            'region' => 'Lozère',
            'status' => 1,
            'latitude' => '44.542679',
            'longitude' => '3.490080',
         ]);
            DB::table('region')->insert([
         'region_id'=>'49',
            'region' => 'Maine-et-Loire',
            'status' => 1,
            'latitude' => '47.389408',
            'longitude' => '-0.559640',
         ]);
            DB::table('region')->insert([
         'region_id'=>'50',
            'region' => 'Manche',
            'status' => 1,
            'latitude' => '39.674061',
            'longitude' => '-3.161330',
         ]);
            DB::table('region',)->insert([
         'region_id'=>'51',
            'region' => 'Marne',
            'status' => 1,
            'latitude' => '40.068192',
            'longitude' => '-82.310638',
         ]);
            DB::table('region')->insert([
         'region_id'=>'52',
            'region' => 'Haute Marne',
            'status' => 1,
            'latitude' => '48.132938',
            'longitude' => '5.259090',
         ]);
            DB::table('region')->insert([
         'region_id'=>'53',
            'region' => 'Mayenne',
            'status' => 1,
            'latitude' => '48.304100',
            'longitude' => '-0.618230',
         ]);
            DB::table('region')->insert([
         'region_id'=>'54',
            'region' => 'Meurthe-et-Moselle',
            'status' => 1,
            'latitude' => '48.645149',
            'longitude' => '6.806030',
         ]);
            DB::table('region')->insert([
         'region_id'=>'55',
            'region' => 'Meuse',
            'status' => 1,
            'latitude' => '49.701241',
            'longitude' => '4.843370',
         ]);
            DB::table('region')->insert([
         'region_id'=>'56',
            'region' => 'Morbihan',
            'status' => 1,
            'latitude' => '30.012011',
            'longitude' => '-91.766823',
         ]);
            DB::table('region')->insert([
         'region_id'=>'57',
            'region' => 'Moselle',
            'status' => 1,
            'latitude' => '31.502871',
            'longitude' => '-89.280937',
         ]);
            DB::table('region')->insert([
         'region_id'=>'58',
            'region' => 'Nièvre',
            'status' => 1,
            'latitude' => '47.238560',
            'longitude' => '3.251500',
         ]);
            DB::table('region')->insert([
         'region_id'=>'59',
            'region' => 'Nord',
            'status' => 1,
            'latitude' => '-26.971359',
            'longitude' => '31.283621',
         ]);
            DB::table('region')->insert([
         'region_id'=>'60',
            'region' => 'Oise',
            'status' => 1,
            'latitude' => '49.277569',
            'longitude' => '2.461870',
         ]);
            DB::table('region')->insert([
         'region_id'=>'61',
            'region' => 'Orne',
            'status' => 1,
            'latitude' => '49.228809',
            'longitude' => '-0.299070',
         ]);
            DB::table('region')->insert([
         'region_id'=>'62',
            'region' => 'Pas-de-Calais',
            'status' => 1,
            'latitude' => '50.128150',
            'longitude' => '2.453530',
         ]);
            DB::table('region')->insert([
         'region_id'=>'63',
            'region' => 'Puy-de-Dôme',
            'status' => 1,
            'latitude' => '45.725948',
            'longitude' => '3.140490',
         ]);
            DB::table('region')->insert([
         'region_id'=>'64',
            'region' => 'Pyrénées Atlantiques',
            'status' => 1,
            'latitude' => '43.187408',
            'longitude' => '-0.881590',
         ]);
            DB::table('region')->insert([
         'region_id'=>'65',
            'region' => 'Hautes Pyrénées',
            'status' => 1,
            'latitude' => '47.301630',
            'longitude' => '7.367770',
         ]);
            DB::table('region')->insert([
         'region_id'=>'66',
            'region' => 'Pyrénées Orientales',
            'status' => 1,
            'latitude' => '38.027720',
            'longitude' => '-121.288830',
         ]);
            DB::table('region')->insert([
         'region_id'=>'67',
            'region' => 'Bas-Rhin',
            'status' => 1,
            'latitude' => '48.599190',
            'longitude' => '7.586570',
         ]);
            DB::table('region')->insert([
         'region_id'=>'68',
            'region' => 'Haut-Rhin',
            'status' => 1,
            'latitude' => '47.885471',
            'longitude' => '7.229540',
         ]);
            DB::table('region')->insert([
         'region_id'=>'69',
            'region' => 'Rhône',
            'status' => 1,
            'latitude' => '44.837261',
            'longitude' => '4.893270',
         ]);
            DB::table('region')->insert([
         'region_id'=>'70',
            'region' => 'Haute Saône',
            'status' => 1,
            'latitude' => '47.641300',
            'longitude' => '6.087380',
         ]);
            DB::table('region')->insert([
         'region_id'=>'71',
            'region' => 'Saône-et-Loire',
            'status' => 1,
            'latitude' => '46.655720',
            'longitude' => '4.544040',
         ]);
            DB::table('region')->insert([
         'region_id'=>'72',
            'region' => 'Sarthe',
            'status' => 1,
            'latitude' => '47.838791',
            'longitude' => '-0.328970',
         ]);
            DB::table('region')->insert([
         'region_id'=>'73',
            'region' => 'Savoie',
            'status' => 1,
            'latitude' => '45.499149',
            'longitude' => '5.999980',
         ]);
            DB::table('region')->insert([
         'region_id'=>'74',
            'region' => 'Haute Savoie',
            'status' => 1,
            'latitude' => '46.069149',
            'longitude' => '6.424750',
         ]);
            DB::table('region')->insert([
         'region_id'=>'75',
            'region' => 'Paris',
            'status' => 1,
            'latitude' => '48.856613',
            'longitude' => '2.352222',
         ]);
            DB::table('region')->insert([
         'region_id'=>'76',
            'region' => 'Seine Maritime',
            'status' => 1,
            'latitude' => '49.661629',
            'longitude' => '0.928600',
         ]);
            DB::table('region')->insert([
         'region_id'=>'77',
            'region' => 'Seine-et-Marne',
            'status' => 1,
            'latitude' => '48.618912',
            'longitude' => '2.975630',
         ]);
            DB::table('region')->insert([
         'region_id'=>'78',
            'region' => 'Yvelines',
            'status' => 1,
            'latitude' => '48.785095',
            'longitude' => '1.825657',
         ]);
            DB::table('region')->insert([
         'region_id'=>'79',
            'region' => 'Deux-Sèvres',
            'status' => 1,
            'latitude' => '46.539162',
            'longitude' => '-0.341810',
         ]);
            DB::table('region')->insert([
         'region_id'=>'80',
            'region' => 'Somme',
            'status' => 1,
            'latitude' => '-28.786200',
            'longitude' => '151.808853',
         ]);
            DB::table('region')->insert([
         'region_id'=>'81',
            'region' => 'Tarn',
            'status' => 1,
            'latitude' => '43.926441',
            'longitude' => '1.988153',
         ]);
            DB::table('region')->insert([
         'region_id'=>'82',
            'region' => 'Tarn-et-Garonne',
            'status' => 1,
            'latitude' => '44.080750',
            'longitude' => '1.368280',
         ]);
            DB::table('region')->insert([
         'region_id'=>'83',
            'region' => 'Var',
            'status' => 1,
            'latitude' => '10.100200',
            'longitude' => '76.264397',
         ]);
            DB::table('region')->insert([
         'region_id'=>'84',
            'region' => 'Vaucluse',
            'status' => 1,
            'latitude' => '47.258438',
            'longitude' => '6.688280',
         ]);
            DB::table('region')->insert([
         'region_id'=>'85',
            'region' => 'Vendée',
            'status' => 1,
            'latitude' => '46.976181',
            'longitude' => '-1.311260',
         ]);
            DB::table('region')->insert([
         'region_id'=>'86',
            'region' => 'Vienne',
            'status' => 1,
            'latitude' => '48.209209',
            'longitude' => '16.372780',
         ]);
            DB::table('region')->insert([
         'region_id'=>'87',
            'region' => 'Haute Vienne',
            'status' => 1,
            'latitude' => '45.919209',
            'longitude' => '1.270490',
         ]);
            DB::table('region')->insert([
         'region_id'=>'88',
            'region' => 'Vosges',
            'status' => 1,
            'latitude' => '48.251259',
            'longitude' => '6.420080',
         ]);
            DB::table('region')->insert([
         'region_id'=>'89',
            'region' => 'Yonne',
            'status' => 1,
            'latitude' => '48.082039',
            'longitude' => '3.294390',
         ]);
            DB::table('region')->insert([
         'region_id'=>'90',
            'region' => 'Territoire de Belfort',
            'status' => 1,
            'latitude' => '47.631550',
            'longitude' => '6.928790',
         ]);
            DB::table('region')->insert([
         'region_id'=>'91',
            'region' => 'Essonne',
            'status' => 1,
            'latitude' => '48.525299',
            'longitude' => '2.385750',
         ]);
            DB::table('region')->insert([
         'region_id'=>'92',
            'region' => 'Hauts-de-Seine',
            'status' => 1,
            'latitude' => '48.828506',
            'longitude' => '2.218807',
         ]);
            DB::table('region')->insert([
         'region_id'=>'93',
            'region' => 'Seine-St-Denis',
            'status' => 1,
            'latitude' => '48.936050',
            'longitude' => '2.365010',
         ]);
            DB::table('region')->insert([
         'region_id'=>'94',
            'region' => 'Val-d-Marnee',
            'status' => 1,
            'latitude' => '49.068370',
            'longitude' => '4.047390',
         ]);
            DB::table('region')->insert([
         'region_id'=>'95',
            'region' => 'Val-D\'Oise',
            'status' => 1,
            'latitude' => '49.082820',
            'longitude' => '2.131180',
         ]);
            DB::table('region')->insert([
         'region_id'=>'971',
            'region' => 'Guadeloupe',
            'status' => 1,
            'latitude' => '16.264999',
            'longitude' => '-61.550999',
         ]);
            DB::table('region')->insert([
         'region_id'=>'972',
            'region' => 'Martinique',
            'status' => 1,
            'latitude' => '14.641528',
            'longitude' => '-61.024174',
         ]);
            DB::table('region')->insert([
         'region_id'=>'973',
            'region' => 'Guyane',
            'status' => 1,
            'latitude' => '3.931110',
            'longitude' => '-53.055260',
         ]);
            DB::table('region')->insert([
         'region_id'=>'974',
            'region' => 'La Réunion',
            'status' => 1,
            'latitude' => '44.294559',
            'longitude' => '0.111310',
         ]);
            DB::table('region')->insert([
         'region_id'=>'976',
            'region' => 'Mayotte',
            'status' => 1,
            'latitude' => '-12.827500',
            'longitude' => '45.166245',
         ]);
          

    }
}