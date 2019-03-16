<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 19:18
 */

namespace App\Application\Usecase;


use App\Application\Command\Signature\SignatureRequest;
use App\Domain\Core\AbstractOutput;
use App\Domain\Core\Usecase;
use App\Domain\Service\WinnerService;
use App\Infrastructure\Output\WinnerOutput;
use Psr\Log\LoggerInterface;

class WinnerUsecase implements Usecase
{

    /** @var SignatureRequest */
    private $plaintiff;

    /** @var SignatureRequest */
    private $defendant;

    /** @var WinnerService */
    private  $winnerService;

    /** @var WinnerOutput */
    private $output;

    /** LoggerInterface */
    private $logger;

    public function __construct(SignatureRequest $plaintiff,
                                SignatureRequest $defendant,
                                WinnerService $winnerService,
                                WinnerOutput $output,
                                LoggerInterface $logger)
    {
        $this->plaintiff = $plaintiff;
        $this->defendant = $defendant;
        $this->winnerService = $winnerService;
        $this->output = $output;
        $this->logger = $logger;

    }

    public function execute()
    {
        try {
            $this->plaintiff->isValid();
            $this->defendant->isValid();
        }
        catch (\Exception $e){
            $this->logger->error('error: '.$e->getMessage(), ['signature.isValid']);
            $this->output->addError($e->getMessage(), 'signature.validation', AbstractOutput::CODE_BAD_REQUEST);
        }

        $winner = $this->winnerService->decideWinner($this->plaintiff, $this->defendant);

        return $this->output->execute($winner);

    }
}