<?php

namespace Hasnularief\Auditor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hasnularief\Auditor\Auditor;

class AuditorController extends Controller
{
    function __construct()
    {
        $middleware = config('auditor.middleware');
        if(is_array($middleware)){
            foreach ($middleware as $m) {
                $this->middleware($m);
            }
        }
        else
        {
            $this->middleware($middleware);    
        }

        
    }

    public function index(Request $request)
    {
        if($request->req == 'table')
        {
            $filters = json_decode($request->filters);
            $d = Auditor::where(function($q) use($filters){
                            if($filters->id)
                                $q->where('id', $filters->id);
                            if($filters->user_name)
                                $q->where('user_name', 'like', "%" . $filters->user_name . "%");
                            if($filters->table_name)
                                $q->where('table_name', 'like', "%" . $filters->table_name . "%");
                            if($filters->request_path)
                                $q->where('request_path', 'like', "%" . $filters->request_path . "%");
                            if($filters->request_param)
                                $q->where('request_param', 'like', "%" . $filters->request_param . "%");
                            if($filters->model)
                                $q->where('model', 'like', "%". $filters->model . "%");
                            if($filters->created_at)
                                $q->where('created_at', 'like', "%" . $filters->created_at . "%");
                        })->paginate($request->per_page);
            return response()->json($d);
        }
        else{
            if(view()->exists('hasnularief/auditor/auditor'))
                return view('hasnularief/auditor/auditor');
            else
                return view('auditor::auditor');
        }           
            
    }
}
