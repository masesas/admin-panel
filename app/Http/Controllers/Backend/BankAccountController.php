<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankAccountModel;
use App\Models\SessionKeyModel;
use Illuminate\Http\Request;

class BankAccountController extends Controller {
    public function store() {
        $userSession = session()->get(SessionKeyModel::USER_LOGIN);

        return response([
            'data' => BankAccountModel::byId($userSession->id),
        ]);
    }
}
