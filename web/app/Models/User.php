<?php

class User {
    /**
     * The name of the database table containing user information.
     *
     * @var string
     */
    const TABLE = 'users';

    /**
     * Vérifie si l'utilisateur est authentifié
     *
     * @return bool True si l'utilisateur est authentifié, False sinon
     */
    public static function isAuthenticated()
    {
        return isset($_SESSION['user']['id']);
    }

    /**
     * Vérifie l'username et le mot de passe d'un utilisateur
     *
     * @return bool True si l'utilisateur existe avec le bon mot de passe
     */
    public static function checkAuthenticate(string $username, string $password)
    {
        return $GLOBALS['DB']->fetch(self::TABLE, ['user' => $username, 'password' => base64_encode($password)]);
    }

    /**
     * Vérifie si l'utilisateur est banni
     * 
     * @param int|null $id L'ID de l'utilisateur à vérifier. Si null, utilise l'ID de l'utilisateur actuellement connecté
     * @return bool True si l'utilisateur est banni, False sinon
     */
    public static function isBanned(int $userId = null) : bool
    {
        if ($userId === null) {
            $userId = $_SESSION['user']['id'] ?? null;
        }
        if($userId === null) return false;

        $user = self::get($userId);
        return (bool)$user['ban'];
    }

    /**
     * Retrieves a user based on their ID, or the currently logged in user's ID if $userId is not specified
     *
     * @param int|null $userId The ID of the user to retrieve, or null to retrieve the currently logged in user
     * @return array The user's data
     */
    public static function get(int $userId = null)
    {
        return ($userId == null) ? $GLOBALS['DB']->fetch(self::TABLE, ['id' => $_SESSION['user']['id']])[0] : $GLOBALS['DB']->GetContent('users', ['id' => $userId]);
    }

    /**
     * Retrieves all users
     *
     * @return array An array of all users
     */
    public static function getAll()
    {
        return $GLOBALS['DB']->GetContent(self::TABLE);
    }

    /**
     * Retrieves the $number most recently created, active, and unbanned accounts
     *
     * @param int $number The number of accounts to retrieve
     * @return array An array of the most recent accounts
     */
    public static function getAllRecent(int $number)
    {
        return $GLOBALS['DB']->fetchAll(self::TABLE, ['active' => 1, 'ban' => 0], "ORDER BY created_at DESC LIMIT $number");
    }

    /**
     * Retrieves the total number of accounts
     *
     * @return int The number of accounts
     */
    public static function count()
    {
        return $GLOBALS['DB']->count(self::TABLE);
    }

    /**
     * Checks if a user exists by their ID
     * 
     * @param int $user_id The ID of the user to check for existence
     * @return bool True if the user exists, False if they do not
     */
    public static function isExist($userId)
    {
        return ($GLOBALS['DB']->count(self::TABLE, ["id" => $userId]) != 0);
    }

    public static function isApiKeyValid(string $key, string $username)
    {
        if ($key == "0") {
            return false; // if api key is not defined
        }

        return (bool)$GLOBALS['DB']->count('users', ['api' => $key, 'user' => $username]);
    }

    public static function getPlan(string $username)
    {
        return $GLOBALS['DB']->fetch(self::TABLE, ['user' => $username])['plan'] ?? null;
    }
}
