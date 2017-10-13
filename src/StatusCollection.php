<?php

/*
 * This file is part of the Laravel StatusBit package.
 *
 * (c) Yvon Viger <yvon@baytek.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Baytek\Laravel\StatusBit;

use Illuminate\Support\Collection;

class StatusCollection extends Collection
{
	public function toClassNamesArray()
	{
		return $this->transform(function ($item) {
			return str_slug(strtolower($item), '-');
		});
	}

	public function toFormatted()
	{
		return $this->implode(', ');
	}

	public function toClassNames()
	{
		return $this->toClassNamesArray()->implode(' ');
	}
}