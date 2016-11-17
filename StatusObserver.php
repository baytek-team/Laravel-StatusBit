<?php

namespace Baytek\LaravelStatusBit;

use App\StatusHistory;

class StatusObserver
{
	public function saved($model)
	{
		if($model->getOriginal('status') != $model->status) {

			$class = class_basename(get_class($model));

			$model->statuses()->keys()->each(function ($status) use ($model, $class)
			{
				$history = new StatusHistory([
					'type_id' => $model->id,
					'type' => $class,
					'status' => $status,
				]);

				$history->save();
			});
		}
	}
}