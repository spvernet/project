<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 18:36
 */

namespace App\Application\Command\Signature;


use App\Domain\Exception\MissingFieldException;
use App\Domain\Exception\NumberSignException;
use App\Domain\Exception\SignNotAllowedException;
use App\Domain\Model\Port\Request;


class SignatureRequest implements Request
{
    const KING = 'K';
    const NOTARY = 'N';
    CONST VALIDATOR ='V';

    /** @var string */
    private $data;

    public function __construct(?string $data)
    {
        $this->data =$data;
    }

    public function isValid(): bool
    {

        if ($this->data == null) {
            throw new MissingFieldException('Field Empty');
        }

        if (strlen($this->data) != 3) {
            throw new NumberSignException('Number of Signatures not allowed');
        }

        $letters = $this->toArray();
        foreach ($letters as $letter){
            if (!in_array($letter, [self::KING,self::NOTARY,self::VALIDATOR])){
                throw new SignNotAllowedException('Sign not Allowed');
                break;
            }
        }

        return true;
    }

    public function toArray(): array {
        return str_split($this->data,1);
    }
}