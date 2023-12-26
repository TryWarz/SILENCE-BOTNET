<?php
class Plan {

	/**
     * The name of the database table.
     *
     * @var string
     */
    const TABLE = 'plans';

    public static function add(string $name, int $maxtime, int $concurrent)
    {
        $GLOBALS['DB']->addRow(self::TABLE, [
            'name' => $name,
            'time' => $maxtime,
            'concurrent' => $concurrent
        ]);
    }

    public static function remove(string $name)
    {
        $GLOBALS['DB']->delete(self::TABLE, ['name' => $name]);
    }

    public static function getPlanLimit(string $planName)
    {
        return $GLOBALS['DB']->fetch(self::TABLE, ['name' => $planName]) ?? null;
    }

    /**
     * Update the plan with the given name, maximum time, and concurrent users.
     *
     * @param string $name The name of the plan.
     * @param int $maxtime The maximum time allowed for the plan.
     * @param int $concurrent The number of concurrent users allowed for the plan.
     * @return void
     */
    public static function updatePlan(string $name, int $maxtime, int $concurrent)
    {
        $GLOBALS['DB']->update(self::TABLE, ['name' => $name], [
            'time' => $maxtime,
            'concurrent' => $concurrent
        ]);
    }
}
