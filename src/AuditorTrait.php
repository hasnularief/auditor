<?php

namespace Hasnularief\Auditor;
use Hasnularief\Auditor\AuditorObserverser;

trait AuditorTrait {

	protected static function boot()
	{
		parent::boot();

		$request = request();

		static::observe(new AuditorObserver($request));
	}
}