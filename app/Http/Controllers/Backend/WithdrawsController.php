<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccountModel;
use App\Models\SessionKeyModel;
use App\Models\WithdrawModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WithdrawsController extends Controller {

    public $userSession;

    public function __construct() {
        $this->userSession = session()->get(SessionKeyModel::USER_LOGIN);
    }

    public function index() {
        $bankAccount = BankAccountModel::withBalanceByUserId($this->userSession->id);
        $balance = format_rupiah(!empty($bankAccount) ? $bankAccount->balance : 0);

        return view('backend.withdraws', compact(
            'bankAccount',
            'balance'
        ));
    }

    public function indexDataTable(Request $request) {
        $withdraws = WithdrawModel::query();
        if ($this->userSession->tipe_user === 'user') {
            $withdraws->where('users_id', $this->userSession->id);
        }

        $witdrawsData = $withdraws->get();

        $dataTable = DataTables::of($witdrawsData)
            ->addIndexColumn()
            ->addColumn('amount', function (WithdrawModel $wd) {
                return '<div class="text-center"><strong>' . format_rupiah($wd->amount) . '</strong></div>';
            })
            ->addColumn('request_date', '<div class="text-center"><strong>{{$request_date}}</strong></div>')
            ->addColumn('status', function (WithdrawModel $wd) {

                return $this->statusStyle($wd->status);
            })
            ->addColumn('action', function (WithdrawModel $wd) {
                //$data as $id
                return view('backend.includes.act_wd', compact('wd'));
            })
            ->rawColumns([
                'amount',
                'request_date',
                'status',
                'action'
            ]);

        return $dataTable->make(true);
    }

    private function statusStyle($status) {
        switch ($status) {
            case 'approved':
                return '<div class="text-center"><strong><span class="badge bg-success p-2">' . ucwords($status) . '</span></div>';
            case 'pending':
                return '<div class="text-center"><strong><span class="badge bg-warning p-2">' . ucwords($status) . '</span></div>';
            case 'canceled':
                return '<div class="text-center"><strong><span class="badge bg-danger p-2">' . ucwords($status) . '</span></div>';
            default:
                return '<div class="text-center"><strong><span class="badge bg-primary p-2">' . ucwords($status) . '</span></div>';
        }
    }
}
