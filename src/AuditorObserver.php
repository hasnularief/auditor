<?php

namespace Hasnularief\Auditor;
use Hasnularief\Auditor\Auditor as Model;
use App\Jobs\SubmitAuditor;

class AuditorObserver
{
    public function deleted($model)
	{
		$this->generate($model);
	}

	public function restored($model)
	{
		$this->generate($model);
	}

	public function saved($model)
	{
		$this->generate($model);
	}

	private function generate($model)
	{
		if(!config('auditor.enable'))
			return;

		$request = request();

		$data = [
			'user_name'     => $request->user()->name,
			'table_name'    => $model->getTable()?:null,
			'request_path'  => $request->path(),
			'request_param' => json_encode($request->all(), JSON_HEX_APOS),
			'model_id'      => $model->id,
			'model'         => json_encode($model->getAttributes(), JSON_HEX_APOS)
		];

		$now = \Carbon\Carbon::now();

		if(config('auditor.mode') == 'job')
			SubmitAuditor::dispatch($data);
		else if(config('auditor.mode') == 'default')
			Model::create($data);

	}
}
