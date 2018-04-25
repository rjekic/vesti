<?php

use Illuminate\Database\Seeder;
use App\KategorijaOglaci;


class KategorijaOglaci extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $KategorijaOglaci = new KategorijaOglaci();
		$KategorijaOglaci->kategorija = 'Alati i oruđa';
		$KategorijaOglaci->save();
		
		$KategorijaOglaci->kategorija = 'Antikviteti i umetnička dela';
		$KategorijaOglaci->save();
		
		$KategorijaOglaci->kategorija = 'Auto-moto';
		$KategorijaOglaci->save();
		
		$KategorijaOglaci->kategorija = 'Audio, TV i video';
		$KategorijaOglaci->save();
    }
}
