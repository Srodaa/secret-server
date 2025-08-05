<?php
namespace App\Controller;

use App\Service\ResponseFormatter;
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
        $acceptHeader = $_SERVER['HTTP_ACCEPT'] ?? 'application/json';
        $responseData = [
            'hash' => $hash,
            'secretText' => $data['secret'],
            'expireAfterViews' => $data['expireAfterViews'],
            'expireAfterTime' => $data['expireAfterTime'],
        ];
        echo ResponseFormatter::format($responseData, $acceptHeader);
    }

    public function getSecret($params) {
        $secret = $this->secretService->getSecret($params['hash']);
        $acceptHeader = $_SERVER['HTTP_ACCEPT'] ?? 'application/json';
        if (!$secret){
            return http_response_code(404);
        }
        echo ResponseFormatter::format($secret, $acceptHeader);
    }
}