<?php

namespace App\Http\Controllers\Pharmacy\Web\Expense\Expenseentry;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Numbertowords;
use App\Models\Pharmacy\Expense\Pharmacyexpenseentry;

class PharmacyexpenseentryController extends Controller
{
    public function index()
    {
        return view('pharmacy.expense.expenseentry.index');
    }

    public function createoredit($expenseentryuuid = null)
    {
        return view('pharmacy.expense.expenseentry.createoredit', compact('expenseentryuuid'));
    }
    public function expenseentryreceiptprint(Pharmacyexpenseentry $expenseentry)
    {
        $amount_in_words = Numbertowords::numbertowords($expenseentry->expense_value);
        return view('pharmacy.expense.expenseentry.expenseentryreceipt', compact('expenseentry', 'amount_in_words'));
    }
}
