<?php 

use App\Lang;
use App\Bunrui;
use App\Codelive;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * データベース初期値設定実行
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $this->call('LangsTableSeeder');
        $this->call('BunruiTableSeeder');
        $this->call('CodelivesTableSeeder');

        Model::reguard();
    }
}
class LangsTableSeeder extends Seeder {
    public function run() {
        DB::table('langs')->delete();
        Lang::create(['language' => 'PHP', 'langmark' => 'php']);
        Lang::create(['language' => 'C++', 'langmark' => 'cpp']);
        Lang::create(['language' => 'C#', 'langmark' => 'csharp']);
        Lang::create(['language' => 'Delphi', 'langmark' => 'pascal']);
    }
}
class BunruiTableSeeder extends Seeder {
    public function run() {
        {
            DB::table('bunruis')->delete();
            $langs = Lang::all();
            foreach($langs as $item) {
                $bun = new Bunrui(['b_name' => '一般', ]);
                $item->bunruis()->save($bun);
            }
        }
    }
}
class CodelivesTableSeeder extends Seeder {

    public function run() {
        DB::table('Codelives')->delete();
        //                                      データを削除
        $bunrui = Bunrui::all()->first();
        // 
        $faker = Faker::create('en_US');

        for ($i = 0; $i < 10; $i++) {
            $codelive = new Codelive(['title' => $faker->sentence(), 'body' => $faker->paragraph(), 'src' => '', ]);
            $bunrui->codelives()->save($codelive);
        }
    }
}