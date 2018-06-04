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
	/**
	 * Convert collection to array of CSS compatible class names
	 * @return array Collection of class names
	 */
	public function toClassNamesArray()
	{
		return $this->transform(function ($item) {
			return str_slug(strtolower($item), '-');
		});
	}

	/**
	 * Convert to comma separated string
	 * @return string Comma separated statuses
	 */
	public function toFormatted()
	{
		return $this->implode(', ');
	}

	/**
	 * Convert to space separated string class names
	 * @return string Space separated CSS class names
	 */
	public function toClassNames()
	{
		return $this->toClassNamesArray()->implode(' ');
	}
}