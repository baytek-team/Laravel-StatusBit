<?php

namespace Baytek\LaravelStatusBit;

class StatusObserver
{
	// Observe the saved method to update status history
	public function saved($model)
	{
		// Get the status column
		$column = config('status.column', 'status');

		// If the status column has change
		if($model->getOriginal($column) != $model->$column) {

			// Get the name of the class in question
			$class = class_basename(get_class($model));

			// Checks to see the changes of status
			$statuses = $model->getOriginal($column) ^ $model->$column;

			// Loop through the set statuses
			$model::$statuses->keys()->each(function ($status) use ($model, $class, $statuses) {

				// Ensure that the bit is set
				if(($status & $statuses) != 0) {

					// Set the history
					$history = new StatusHistory([
						'type_id' => $model->id,
						'type' => $class,
						'status' => $status,
						'comment' => $model->statusComment,
						'state' => ($model->$column & $status) != 0 ? 1 : 0
					]);

					// Save the history
					return $history->save();
				}
			});
		}
	}
}