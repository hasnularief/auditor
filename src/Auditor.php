<?php

namespace Hasnularief\Auditor;

use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
	public $fillable = ['user_name', 'table_name','request_path', 'request_param', 'model_id', 'model'];

	public function __construct()
	{
		parent::__construct();

		$this->connection = config('auditor.connection');
	}
}
