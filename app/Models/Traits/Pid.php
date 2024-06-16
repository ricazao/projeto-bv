<?php

namespace App\Models\Traits;

trait Pid
{
    /**
     * Initialize the trait.
     *
     * @return void
     */
    public function initializePid()
    {
        $this->usesUniqueIds = true;
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array
     */
    public function uniqueIds()
    {
        return [$this->getPidColumn()];
    }

    /**
     * Generate a new PID for the model.
     *
     * @return string
     */
    public function newUniqueId()
    {
        return pid();
    }

    /**
     * Get the name of the "pid" column.
     *
     * @return string
     */
    public function getPidColumn()
    {
        return defined('static::PID') ? static::PID : 'pid';
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return $this->getPidColumn();
    }
}
