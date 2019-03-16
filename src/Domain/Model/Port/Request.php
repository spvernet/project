<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 18:39
 */

namespace App\Domain\Model\Port;


interface Request
{
    public function isValid(): bool;
}