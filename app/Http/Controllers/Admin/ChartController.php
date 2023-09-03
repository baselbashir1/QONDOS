<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\MaintenanceTechnician;
use App\Models\User;

class ChartController extends Controller
{
    public function index()
    {
        $services = count(Service::all());
        $subCategories = count(SubCategory::all());
        $categories = count(Category::all());
        $users = count(User::all());
        $clients = count(Client::all());
        $maintenances = count(MaintenanceTechnician::all());

        // $result = DB::select(DB::raw("select count(ename) as emp_name, dept.dname from emp LEFT JOIN dept ON dept.deptno = emp.deptno GROUP BY emp.deptno"));
        // $data = "";

        // foreach ($result as $val) {
        //     $data .= "['" . $val->dname . "',     " . $val->emp_name . "],";
        // }
        // $chartData = $data;
        // return view('dashboard', ['chartData' => $chartData]);


        return view('dashboard', [
            'services' => $services,
            'subCategories' => $subCategories,
            'categories' => $categories,
            'users' => $users,
            'clients' => $clients,
            'maintenances' => $maintenances
        ]);
    }
}
