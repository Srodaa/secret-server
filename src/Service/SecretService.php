<?php
namespace App\Service;

use App\Model\Secret;

class SecretService {

    private $secretModel;

    public function __construct(Secret $secretModel) {
        $this->secretModel = $secretModel;
    }

    public function createSecret($data) {
        return $this->secretModel->create($data['secret'], $data['expireAfterViews'], $data['expireAfterTime']);
    }

    public function getSecret($hash) {
        $secret = $this->secretModel->getSecretByHash($hash);
        if (!$secret) return null;
        return $secret;
    }
}