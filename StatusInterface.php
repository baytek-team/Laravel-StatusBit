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

interface StatusInterface {

	public function scopeIncludeStatus($query, $status);
	public function scopeExcludeStatus($query, $status);

}

