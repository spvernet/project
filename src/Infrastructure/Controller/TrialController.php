<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 18:20
 */

namespace App\Infrastructure\Controller;


use App\Application\Command\Signature\SignatureRequest;
use App\Application\Usecase\WinnerUsecase;
use App\Domain\Service\WinnerService;
use App\Infrastructure\Output\WinnerOutput;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class TrialController
{


    public function validate(Request $request, WinnerService $winnerService, LoggerInterface $logger) {


        $plaintiff = new SignatureRequest($request->get('plaintiff'));
        $defendant = new SignatureRequest($request->get('defendant'));

        $usecase = new WinnerUsecase(
            $plaintiff,
            $defendant,
            $winnerService,
            new WinnerOutput(),
            $logger);

        return $usecase->execute();
    }
}