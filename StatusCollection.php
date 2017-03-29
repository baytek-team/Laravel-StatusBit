<?php

/*
 * This file is part of the Laravel StatusBit package.
 *
 * (c) Yvon Viger <yvon@baytek.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Baytek\LaravelStatusBit;

use Illuminate\Support\Collection;

class StatusCollection extends Collection
{
	public function toClassNames()
	{
		return $this->transform(function ($item) {
			return str_slug(strtolower($item), '-');
		})->implode(' ');
	}

	public function toFormatted()
	{
		return $this->implode(', ');
	}
}