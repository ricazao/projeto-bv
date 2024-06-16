<?php

namespace App\Models\Traits;

use App\Observers\UserstampObserver;

trait HasUserstamps
{
    /**
     * Boot the userstamps trait for a model.
     *
     * @return void
     */
    public static function bootHasUserstamps()
    {
        static::observe(UserstampObserver::class);
    }

    /**
     * Has the model loaded the SoftDeletes trait.
     *
     * @return bool
     */
    public function usingSoftDeletes()
    {
        return in_array(
            'Illuminate\Database\Eloquent\SoftDeletes',
            class_uses_recursive(get_called_class())
        );
    }

    /**
     * Get the user that created the model.
     */
    public function creator()
    {
        return $this
            ->belongsTo(
                config('userstamps.user_class'),
                $this->getCreatedByColumn()
            )
            ->withDefault(config('userstamps.fallback_user'));
    }

    /**
     * Get the user that edited the model.
     */
    public function updater()
    {
        return $this
            ->belongsTo(
                config('userstamps.user_class'),
                $this->getUpdatedByColumn()
            )
            ->withDefault(config('userstamps.fallback_user'));
    }

    /**
     * Get the user that deleted the model.
     */
    public function destroyer()
    {
        return $this
            ->belongsTo(
                config('userstamps.user_class'),
                $this->getDeletedByColumn()
            )
            ->withDefault(config('userstamps.fallback_user'));
    }

    /**
     * Get the name of the "created by" column.
     *
     * @return string
     */
    public function getCreatedByColumn()
    {
        return defined('static::CREATED_BY') ? static::CREATED_BY : 'created_by';
    }

    /**
     * Get the name of the "updated by" column.
     *
     * @return string
     */
    public function getUpdatedByColumn()
    {
        return defined('static::UPDATED_BY') ? static::UPDATED_BY : 'updated_by';
    }

    /**
     * Get the name of the "deleted by" column.
     *
     * @return string
     */
    public function getDeletedByColumn()
    {
        return defined('static::DELETED_BY') ? static::DELETED_BY : 'deleted_by';
    }

    /**
     * Check if we're maintaing Userstamps on the model.
     *
     * @return bool
     */
    public function usesUserstamps()
    {
        return $this->userstamps ?? false;
    }
}
