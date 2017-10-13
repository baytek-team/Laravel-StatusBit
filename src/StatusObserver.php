<?php

namespace Baytek\Laravel\StatusBit;

class StatusObserver
{
	public function saved($model)
	{
		$column = config('status.column', 'status');

		if($model->getOriginal($column) != $model->$column) {

			$class = class_basename(get_class($model));

			$statuses = $model->getOriginal($column) ^ $model->$column;

			$model::$statuses->keys()->each(function ($status) use ($model, $class, $statuses) {

				if(($status & $statuses) != 0) {

					$history = new StatusHistory([
						'type_id' => $model->id,
						'type' => $class,
						'status' => $status,
						'comment' => $model->statusComment,
					]);

					$history->save();
				}
			});
		}
	}
}