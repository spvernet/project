<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 2019-03-16
 * Time: 19:07
 */

namespace App\Infrastructure\Output;


use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\Core\AbstractOutput;

class WinnerOutput extends AbstractOutput
{

    public function execute(array $data = null)
    {
        $this->init();
        if (is_array($data) && array_key_exists('errors' , $data)) {
            return new JsonResponse($data, self::CODE_BAD_REQUEST);
        } elseif ($this->hasErrors()) {
            $error = $this->getErrors();
            return new JsonResponse($error, $error['metadata'][0]['code']);
        }
        $this->output['data']= $data[0];
        return new JsonResponse($this->output);
    }
}