<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Requests\CsvImportRequest;
use App\Http\Requests\UserRequest;
use App\Imports\UsersImport;
use App\Models\User;
use App\Service\PromotionService;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use PDF;
use Excel;

class UserController extends Controller
{
    protected $userService;
    protected $promotionService;

    public function __construct(UserService $userService, PromotionService $promotionService)
    {
        $this->userService = $userService;
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function getList()
    {
        return DataTables::of($this->userService->users())
            ->addColumn('action', function ($user) {
                return
                    '<a href="users/' . $user->id . '/edit" class="btn btn-sm btn-outline-primary" > <i class="fa fa-pencil"></i></a>
                    <a href="users/' . $user->id . '/delete" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure ?\')"> <i class="fa fa-trash-o"></i></a>
                    ';
            })
            ->make(true);
    }

    public function create()
    {
        $roles = $this->userService->roles();

        return view('admin.user.form', compact('roles'));
    }

    public function actionCreate(UserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $this->userService->createOrUpdate($request);
            $this->userService->saveRoleUser(User::max('id'), $request->role);
        });

        return redirect()->route('admin.users.index')->with('message', 'Create User Successfully !');
    }

    public function edit(User $user)
    {
        $roles = $this->userService->roles();

        return view('admin.user.form', compact('user', 'roles'));
    }

    public function actionEdit(UserRequest $request, User $user)
    {
        DB::transaction(function () use ($request, $user) {
            $this->userService->createOrUpdate($request, $user->id);
            $this->userService->saveRoleUser($user->id, $request->role);
        });

        return redirect()->route('admin.users.index')->with('message', 'Edit User Successfully !');
    }

    public function delete(User $user)
    {
        if ($user->orders->isEmpty()) {
            $this->userService->delete($user);

            return redirect()->route('admin.users.index')->with('message', 'Delete User Successfully !');
        }

        return redirect()->route('admin.users.index')->with('error', 'You Can\'t Delete User');
    }

    public function sendMail(Request $request)
    {
        $promotions = $this->promotionService->getPromotions();
        $count = $this->userService->sendMailFromAdmin($request->Ids, $promotions);

        return response()->json($count, 200);
    }

    public function exportPDF()
    {
        $users = $this->userService->users();

        $pdf = PDF::loadView('admin.export-pdf.users', compact('users'));
        //$pdf->save(storage_path().'_users.pdf');
        return $pdf->download('users'.Carbon::now().'.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, Carbon::now()->format('YmdH:i:s').'users.xlsx');
    }

}

