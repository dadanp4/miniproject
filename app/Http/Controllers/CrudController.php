<?php

namespace App\Http\Controllers;

use App\tb_m_client;
use App\tb_m_project;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use IntlDateFormatter;
use stdClass;

class CrudController extends Controller
{


    public function index()
    {

        session_start();
        function ChangeFormatDate($originalDate){
            return Carbon::createFromFormat('Y-m-d', $originalDate)->locale('id')->isoFormat('LL');
        }
        $dataclient = tb_m_client::all();
        $dataproject = tb_m_project::join('tb_m_clients', 'tb_m_projects.client_id', '=','tb_m_clients.client_id')->select('tb_m_projects.*','tb_m_clients.*')->get();
        $dataconvert = array();
        foreach ($dataproject as $key => $value) {
            $dataconvert[] = ([
                'project_id' => $value->project_id,
                'project_name' => $value->project_name,
                'client_name' => $value->client_name,
                'project_start' => ChangeFormatDate($value->project_start),
                'project_end' => ChangeFormatDate($value->project_end),
                'project_status' => $value->project_status,
            ]);
        }
        $username = $_SESSION["username"];
        $token_session = $_SESSION["token"];
        return view('index')->with(['dataclient' => $dataclient, 'dataproduct' => $dataconvert, 'username' => strtoupper($username), 'token_session' => $token_session]);

    }

    public function save(Request $request){
        $dataclient = tb_m_client::where('client_name',$request->client_opsi)->get();
        $dataclientinsert = tb_m_project::insert([
            'project_name' => $request->project_name,
            'client_id' => $dataclient[0]->client_id,
            'project_start' => $request->project_start,
            'project_end' => $request->project_end,
            'project_status' => $request->status_opsi,
        ]);

        if ($dataclientinsert) {
            return redirect('/api/auth/index')->with('message_save_success', 'data berhasil tersimpan');
        }else{
            return redirect('/api/auth/index')->with('message_save_fail', 'data gagal tersimpan');
        }
    }

    public function change(Request $request){
        session_start();
        $username = $_SESSION["username"];
        $token_session = $_SESSION["token"];
        $dataclient = tb_m_client::all();
        $dataproject = tb_m_project::join('tb_m_clients', 'tb_m_projects.client_id', '=','tb_m_clients.client_id')->select('tb_m_projects.*','tb_m_clients.*')->where('tb_m_projects.project_id', 'like', '%'.$request->id.'%')->get();
        return view('change')->with(['dataclient' => $dataclient, 'dataproduct' => $dataproject, 'username' => $username, 'token_session' => $token_session]);
    }

    public function changedata(Request $request){
        $id_client = tb_m_client::where('client_name', 'like', '%'.$request->project_client_name_change.'%')->get();

        DB::table('tb_m_projects')->where('project_id', $request->project_id_change)->update([
            'project_name' => $request->project_name_change,
            'client_id' => $id_client[0]->client_id,
            'project_start' => $request->project_start_change,
            'project_end' => $request->project_end_change,
            'project_status' => $request->project_status_change,
        ]);
        return redirect('/api/auth/index');
    }

    public function delete(Request $request){
        $data = explode(",", $request->id_delete);
        $countdata = count($data);
        for ($i=0; $i < $countdata; $i++) {
            tb_m_project::where('tb_m_projects.project_id', $data[$i])->delete();
        }
        // tb_m_project::where('project_id', 'like', '%'.$request->id_delete.'%')->delete();
        return redirect('api/auth/index');
    }

    public function search(Request $request){

        session_start();
        $username = $_SESSION["username"];
        $token_session = $_SESSION["token"];
        function ChangeFormatDateSearch($originalDate){
            return Carbon::createFromFormat('Y-m-d', $originalDate)->locale('id')->isoFormat('LL');
        }

        $dataclient = tb_m_client::all();
        $dataproject = tb_m_project::join('tb_m_clients', 'tb_m_projects.client_id', '=','tb_m_clients.client_id')->select('tb_m_projects.*','tb_m_clients.*')->where('tb_m_projects.project_name', 'like', '%'.$request->project_name_search.'%')->where('tb_m_projects.project_status', 'like', '%'.$request->status_opsi.'%')->where('tb_m_clients.client_name', 'like', '%'.$request->client_opsi.'%')->get();

        $dataconvert = array();

        foreach ($dataproject as $key => $value) {
            $dataconvert[] = ([
                'project_id' => $value->project_id,
                'project_name' => $value->project_name,
                'client_name' => $value->client_name,
                'project_start' => ChangeFormatDateSearch($value->project_start),
                'project_end' => ChangeFormatDateSearch($value->project_end),
                'project_status' => $value->project_status,
            ]);
        }

        if (count($dataproject) > 0) {
            return view('index')->with(['dataclient' => $dataclient, 'dataproduct' => $dataconvert, 'username' => $username, 'token_session' => $token_session]);
        }else{
            session()->flash('message_search', 'data tidak ditemukan');
            return view('index')->with(['dataclient' => $dataclient, 'dataproduct' => $dataconvert, 'username' => $username, 'token_session' => $token_session]);
        }

    }

    public function logout()
    {
        // auth()->logout();
        session_start();
        session_unset();
        session_destroy();
        return redirect('/');
    }

}
