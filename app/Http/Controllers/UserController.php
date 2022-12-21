<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('user_statuses', 'users.status_id', '=', 'user_statuses.id')
            ->select(
                'users.*',
                'departments.name as department',
                'user_statuses.name as status'
            )->paginate();
        return response()->json($users);
    }

    public function create()
    {
        $user_statuses = UserStatus::select(
            'id as value',
            'name as label'
        )->get();
        $departments = Department::select(
            'id as value',
            'name as label'
        )->get();

        return response()->json([
            'user_statuses' => $user_statuses,
            'departments' => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_id' => 'required',
            'department_id' => 'required',
            'username' => 'required|unique:users,username',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ], [
            'status_id.required' => 'Nhập tình trạng',
            'department_id.required' => 'Nhập phòng ban',
            'username.required' => 'Nhập tên tài khoản',
            'username.unique' => 'Tài khoản đã tồn tại',
            'name.required' => 'Nhập họ và tên',
            'name.max' => 'Ký tự tối đa là 255',
            'email.required' => 'Nhập Email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu và Xác nhận mật khẩu không khớp',
        ]);

        // User::create([
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'status_id' => $request->status_id,
        //     'department_id' => $request->department_id,
        // ]);

        $user = $request->except(['password', 'password_confirmation']);
        $user['password'] = Hash::make($request->password);
        User::create($user);
    }

    public function edit($id)
    {
        $users = User::find($id);
        $user_statuses = UserStatus::select(
            'id as value',
            'name as label'
        )->get();
        $departments = Department::select(
            'id as value',
            'name as label'
        )->get();

        return response()->json([
            'users' => $users,
            'user_statuses' => $user_statuses,
            'departments' => $departments
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_id' => 'required',
            'department_id' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'name' => 'required|max:255',
            'email' => 'required|email',
        ], [
            'status_id.required' => 'Nhập tình trạng',
            'department_id.required' => 'Nhập phòng ban',
            'username.required' => 'Nhập tên tài khoản',
            'username.unique' => 'Tài khoản đã tồn tại',
            'name.required' => 'Nhập họ và tên',
            'name.max' => 'Ký tự tối đa là 255',
            'email.required' => 'Nhập Email',
            'email.email' => 'Email không hợp lệ',
        ]);

        User::find($id)->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'status_id' => $request->status_id,
            'department_id' => $request->department_id,
        ]);

        if ($request->change_password == true) {
            $validated = $request->validate([
                'password' => 'required|confirmed',
            ], [
                'password.required' => 'Nhập mật khẩu',
                'password.confirmed' => 'Mật khẩu và Xác nhận mật khẩu không khớp',
            ]);

            User::find($id)->update([
                'password' => Hash::make($request->password),
                'change_password_at' => now()
            ]);
        }
    }
}
