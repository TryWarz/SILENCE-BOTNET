<?php
class Logs
{
	/**
     * The name of the database table containing log entries.
     *
     * @var string
     */
    const TABLE = 'logs';

    /**
     * Retrieves the last `n` log entries from the database.
     *
     * @param int $limit The number of log entries to retrieve.
     *
     * @return mixed
     */
    public static function getLastLogEntries(int $limit = 20)
    {
        return $GLOBALS['DB']->GetContent(self::TABLE, [], 'ORDER BY id DESC LIMIT '.$limit);
    }

    /**
     * Inserts a new log entry into the database.
     *
     * @param string $content The content of the log entry.
     * @param string $color   The color of the log entry text.
     * @param string $icon    The icon associated with the log entry.
     *
     * @return void
     */
    public static function addLogEntry(string $content, string $color = "primary", string $icon = ""): void
    {
		$GLOBALS['DB']->Insert(self::TABLE, ["content" => "<p class='text-$color'>[".date('d/m/Y à H:i:s', time())."|(".CSRF::GetVisitorIP().")]&nbsp;<i class='$icon'></i>&nbsp;$content</p>"], false);
	}
}
