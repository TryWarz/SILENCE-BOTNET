<?php
class RateLimit {

	/**
     * The name of the database table.
     *
     * @var string
     */
    const TABLE = 'cooldowns';

    private static function createUserRequest(string $username, int $requestCount)
    {
        $GLOBALS['DB']->addRow(self::TABLE, [
            'username' => $username,
            'request_count' => $requestCount,
        ]);
    }

    private static function count(string $username) {
        return $GLOBALS['DB']->count(self::TABLE, ['username' => $username]);
    }

    private static function update(string $username, int $requestCount) {
        $GLOBALS['DB']->update(self::TABLE, ['username' => $username], ['request_count' => $requestCount]);
    }

    private static function getByUsername(string $username) {
        return $GLOBALS['DB']->fetch(self::TABLE, ['username' => $username]);
    }

    public static function checkRequestLimit($username)
    {
        $userRequestCount = $GLOBALS['DB']->count(self::TABLE, ['username' => $username]);

        // Si l'utilisateur n'existe pas, l'ajouter à la table
        if ($userRequestCount == 0) {
            self::createUserRequest($username, 1);
        } else {
            $request = self::getByUsername($username);
            $currentTime = time();
            $requestCount = $request['request_count'];

            $timeSinceLastRequest = $currentTime - strtotime($request['cooldown_expiry']);

            if ($timeSinceLastRequest < API_COOLDOWN_TIME && $request['request_count'] >= API_MAX_REQUESTS) {
                $cooldown_remaining = API_COOLDOWN_TIME - $timeSinceLastRequest;
                $error_response = [
                    "error" => true,
                    "reason" => "You are on cooldown for $cooldown_remaining seconds"
                ];
                echo json_encode($error_response);
                exit;
            } else {
                // Si le cooldown est terminé, supprimez les enregistrements de demande pour l'utilisateur
                if ($timeSinceLastRequest >= API_COOLDOWN_TIME) {
                    $GLOBALS['DB']->delete(self::TABLE, ['username' => $username]);
                } else {
                    // Mettre à jour le compteur et l'heure de la dernière requête
                    $requestCount++;
                    self::update($username, $requestCount);
                }
            }
        }
    }
}
