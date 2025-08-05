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

        $createdAt = strtotime($secret['created_at']);
        $ttl = $secret['expire_after_time'] * 60;
        if ($ttl > 0 && (time() - $createdAt) > $ttl) {
            $this->secretModel->deleteByHash($hash);
            return null;
        }

        $this->secretModel->decreaseViews($hash);
        if($secret['expire_after_views'] - 1 <= 0) {
            $this->secretModel->deleteByHash($hash);
        }

        return $secret;
    }
}