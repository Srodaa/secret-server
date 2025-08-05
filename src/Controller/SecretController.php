<?php
namespace App\Controller;

use App\Service\SecretService;
use http\Env\Request;
use http\Env\Response;

class SecretController {
    private $secretService;

    public function __construct(SecretService $secretService) {
        $this->secretService = $secretService;
    }

    public function create(){
        $data = json_decode(file_get_contents('php://input'), true);
        $hash = $this->secretService->createSecret($data);
        $responseData = [
            'hash' => $hash,
            'secretText' => $data['secret'],
            'expireAfterViews' => $data['expireAfterViews'],
            'expireAfterTime' => $data['expireAfterTime'],
        ];
        echo json_encode($responseData);
    }
}