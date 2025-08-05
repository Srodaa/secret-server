<?php
namespace App\Model;

use PDO;

class Secret {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create($secretText, $expireAfterViews, $expireAfterTime) {
        $hash = bin2hex(random_bytes(32));
        $stmt = $this->db->prepare("INSERT INTO defaultdb.secrets (hash, secret_text, expire_after_views, expire_after_time, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$hash, $secretText, $expireAfterViews, $expireAfterTime]);
        return $hash;
    }

    public function getSecretByHash($hash) {
        $stmt = $this->db->prepare("SELECT * FROM defaultdb.secrets WHERE hash = ?");
        $stmt->execute([$hash]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}