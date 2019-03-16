<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 20:23
 */

namespace App\Tests\Unit\Domain\Service;


use App\Application\Command\Signature\SignatureRequest;
use App\Domain\Service\WinnerService;
use PHPUnit\Framework\TestCase;

class WinnerServiceTest extends TestCase
{

    public function testWinner() {
        $signature1= new SignatureRequest('KNN');
        $signature2 = new SignatureRequest('NNN');
        $service = new WinnerService();

        $this->assertEquals(['plaintiff'], $service->decideWinner($signature1, $signature2));

    }
}