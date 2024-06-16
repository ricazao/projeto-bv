<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class UserstampObserver
{
    /**
     * Handle to the User "creating" event.
     *
     * @return void
     */
    public function creating(Model $model)
    {
        if (! $model->usesUserstamps()) {
            return;
        }

        if (! (is_null($model->getCreatedByColumn()))) {
            $model->{$model->getCreatedByColumn()} = optional(request()->user())->getAuthIdentifier();
        }

        if (! (is_null($model->getUpdatedByColumn()))) {
            $model->{$model->getUpdatedByColumn()} = optional(request()->user())->getAuthIdentifier();
        }
    }

    /**
     * Handle to the User "updating" event.
     *
     * @return void
     */
    public function updating(Model $model)
    {
        if (! $model->usesUserstamps()) {
            return;
        }

        if (! (is_null($model->getUpdatedByColumn()))) {
            $model->{$model->getUpdatedByColumn()} = optional(request()->user())->getAuthIdentifier();
        }
    }

    /**
     * Handle to the User "deleting" event.
     *
     * @return void
     */
    public function deleting(Model $model)
    {
        if (! $model->usingSoftDeletes()) {
            return;
        }

        if (! $model->usesUserstamps()) {
            return;
        }

        if (! (is_null($model->getDeletedByColumn()))) {
            $model->{$model->getDeletedByColumn()} = optional(request()->user())->getAuthIdentifier();
            $this->saveWithoutEventDispatching($model);
        }
    }

    /**
     * Handle to the User "restoring" event.
     *
     * @return void
     */
    public function restoring(Model $model)
    {
        if (! $model->usingSoftDeletes()) {
            return;
        }

        if (! $model->usesUserstamps()) {
            return;
        }

        if (! (is_null($model->getDeletedByColumn()))) {
            $model->{$model->getDeletedByColumn()} = null;
            $this->saveWithoutEventDispatching($model);
        }
    }

    /**
     * Saves a model by ignoring all other event dispatchers.
     *
     * @return bool
     */
    private function saveWithoutEventDispatching(Model $model)
    {
        $eventDispatcher = $model->getEventDispatcher();

        $model->unsetEventDispatcher();
        $saved = $model->save();
        $model->setEventDispatcher($eventDispatcher);

        return $saved;
    }
}
