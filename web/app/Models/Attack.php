<?php
class Attack {

    
	/**
     * The name of the database table.
     *
     * @var string
     */
    const TABLE = 'logs';

    public static function addEntry(string $username, string $host, int $port, int $time, string $methods, int $concurrent)
    {
        $endtime = time() + $time;
        $end = date('Y-m-d H:i:s', $endtime);

        $webhook = new DiscordWebhook(WEBHOOK_URL);
        $webhook->sendMessage($host, $port, $time, strtoupper($methods), $username);

        $GLOBALS['DB']->addRow(self::TABLE, [
            'user' => $username,
            'host' => $host,
            'port' => $port,
            'time' => $time,
            'methods' => $methods,
            'end' => $end,
            'conc_max' => $concurrent
        ]);
    }

    public static function isAlreadyUnderAttack(string $host)
    {
        return (bool)$GLOBALS['DB']->count(self::TABLE, ['host' => $host], " AND (user != 'root' AND user != 'trywarz')");
    }

    public static function countAttackFromUser(string $username)
    {
        return $GLOBALS['DB']->count(self::TABLE, ['user' => $username]);
    }

    public static function hasAvailableSlots()
    {
        return !($GLOBALS['DB']->count(self::TABLE) < API_MAX_SLOTS);
    }

    public static function getAll()
    {
        return $GLOBALS['DB']->fetchAll(self::TABLE);
    }

    public static function remove(int $id)
    {
        return $GLOBALS['DB']->delete(self::TABLE, ['id' => $id]);
    }

}