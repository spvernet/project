<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 20:25
 */

namespace App\Tests\Integration\Application\Usecase;


use App\Domain\Core\AbstractOutput;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WinnerUsecaseTest extends WebTestCase
{

    public function testTrialOK() {

        $client = $this->createClient();

        $client->request(
            'GET',
            '/trial/KNN/NNV'
            );

        $result= json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(AbstractOutput::CODE_OK, $client->getResponse()->getStatusCode());

        $this->assertEquals('plaintiff', $result['data']);
    }

    public function testTrialKO() {

        $client = $this->createClient();

        $client->request(
            'GET',
            '/trial/KTN/NNV'
            );

        $result= json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(AbstractOutput::CODE_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this->assertEquals('Sign not Allowed', $result['metadata'][0]['message']);
    }


}