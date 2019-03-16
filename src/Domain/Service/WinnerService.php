<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 19:26
 */

namespace App\Domain\Service;



use App\Application\Command\Signature\SignatureRequest;

class WinnerService
{
    const KING = 'K';
    const VALIDATOR = 'V';
    const NOTARY = 'N';


    public function decideWinner( SignatureRequest $plaintiff, SignatureRequest $deffendant): array {

        $p = $plaintiff->toArray();
        $d = $deffendant->toArray();

        if ($this->isKing($p) && $this->isValidator($p)){
            unset($p[self::VALIDATOR]);
        }
        if ($this->isKing($d) && $this->isValidator($d)){
            unset($d[self::VALIDATOR]);
        }

        $p_points = $this->sumPoints($p);
        $d_points = $this->sumPoints($d);

        if ($p_points > $d_points) {
            return  ($p_points >= $d_points) ? ['plaintiff'] : ['defendant'];
        }

    }



    private function isKing(array $data):bool {
        foreach ($data as $d){
            if ($d == 'K'){
                return true;
            }
        }
        return false;
    }

    private function isValidator(array $data):bool {
        foreach ($data as $d){
            if ($d == 'V'){
                return true;
            }
        }
        return false;
    }

    private function sumPoints(array $arr): int {
        $points = 0;
        foreach( $arr as $a){
            if ($a == self::KING) {
                $points+=5;
            }
            if ($a == self::NOTARY) {
                $points+=2;
            }
            if ($a == self::VALIDATOR) {
                $points+=1;
            }
        }
        return $points;
    }
}