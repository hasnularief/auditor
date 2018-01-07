<?php

namespace Hasnularief\Auditor;
use Hasnularief\Auditor\AuditorObserverser;

trait AuditorTrait {

	protected static function boot()
	{
		parent::boot();

		static::observe(new AuditorObserver());
	}
}