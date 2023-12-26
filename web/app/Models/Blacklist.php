<?php
class Blacklist {

    
	/**
     * The name of the database table.
     *
     * @var string
     */
    const TABLE = 'blacklists';

    public static function add(string $host)
    {
        $GLOBALS['DB']->addRow(self::TABLE, ['host' => $host]);
    }

    public static function remove(string $host)
    {
        $GLOBALS['DB']->delete(self::TABLE, ['host' => $host]);
    }

    public static function verify(string $host)
    {
        $blacklistHosts = self::getAll();

        foreach ($blacklistHosts as $blacklist) {
            if (preg_match("#" . $blacklist['host'] . "#", $host)) {
                return true;
            }
        }
        return false;
    }

    private static function getAll()
    {
        return $GLOBALS['DB']->fetchAll(self::TABLE);
    }
}