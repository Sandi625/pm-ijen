<?php

namespace App\Traits;

trait KriteriaTrait
{
    public function tentukanKriteriaUnggulanshow($hasil)
    {
        $max = null;
        $kriteriaUnggul = 'Belum Dinilai';

        foreach ($hasil['detail'] as $detail) {
            $nilai = $detail['nilai_total'] ?? null;
            if ($nilai !== null && ($max === null || $nilai > $max)) {
                $max = $nilai;
                $kriteriaUnggul = $detail['nama'];
            }
        }

        return $kriteriaUnggul;
    }
}
