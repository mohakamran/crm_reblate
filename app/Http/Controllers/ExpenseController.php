<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Expense;

class ExpenseController extends Controller
{
    public function addExpenseRoute() {
        $title = "Add New Expense";
        $route = "/add-new-expense";
        $btn_text = "Add New Expense";
        return view('expenses.add-new-expense')->with(compact('title','route','btn_text'));
    }
    // add data and save to database
    public function addExpenseData(Request $req) {
        $validate = $req->validate([
            'ex_amount' => 'required',
            'ex_date' => 'required',
            'ex_parent_category' => 'required',
            'ex_child_category' => 'required',
            'ex_description' => 'nullable',
        ]);
        if($req->ex_description == "") {
           $expense_des = "no description";
        } else {
            $expense_des = $req->ex_description;
        }

        $ex = new Expense();
        $ex->expense_amount	= $req->ex_amount;
        $ex->expense_date	= $req->ex_date;
        $ex->expense_parent_category	= $req->ex_parent_category;
        $ex->expense_child_category	= $req->ex_child_category;
        $ex->expense_description	= $expense_des;
        $ex->save();
        session()->flash('success', 'Expense Added Successfully!');
        return back();
    }

    public function viewExpenses() {
        $rec = Expense::orderBy('id', 'desc')->get();
        if($rec !=null) {
            $title = "Reblate Solutions Expenses";
            $data  = compact('rec','title');
            return view('expenses.view-expenses')->with($data);
        } else {
            return redirect('/');
        }

    }
    // delete expense id from database
    public function deleteExpenses($id){
        $emp_data = Expense::find($id);
        if($emp_data) {
            $emp_data->delete();
            return response()->json(['message' => 'success']);
        } else {
            // return redirect('manage-employees');
            return response()->json(['message' => 'failed']);
        }
    }
    // update expensesn route
    public function updateExpenseRoute($id) {
        $emp_data = Expense::find($id);
        if($emp_data) {
            $title = "Update Expense";
            $route="/update-expense-data/".$id;
            $btn_text = "Update Expense";
            $data = compact('title','btn_text', 'emp_data', 'route');
            return view('expenses.update-expenses')->with($data);
        }
        else {
            return redirect('/');
        }
    }

    public function updateExpenseData($id, Request $req) {
        $emp_data = Expense::find($id);
        if($emp_data !=null) {
            $validate = $req->validate([
                'ex_amount' => 'required',
                'ex_date' => 'required',
                'ex_parent_category' => 'required',
                'ex_child_category' => 'required',
                'ex_description' => 'nullable',
            ]);
            if($req->ex_description == "") {
               $expense_des = "no description";
            } else {
                $expense_des = $req->ex_description;
            }


            $emp_data->expense_amount = $req->ex_amount;
            $emp_data->expense_date	= $req->ex_date;
            $emp_data->expense_parent_category	= $req->ex_parent_category;
            $emp_data->expense_child_category	= $req->ex_child_category;
            $emp_data->expense_description	= $expense_des;
            $emp_data->save();
            session()->flash('success', 'Expense Updated Successfully!');
            return back();
        } else {
            return redirect('/');
        }
    }
}
