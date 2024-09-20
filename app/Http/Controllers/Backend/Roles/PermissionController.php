<?php

namespace App\Http\Controllers\Backend\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách quyền người dùng', 'url' => route('admin.permission.index')],      
        ];
        $permissions = Permission::paginate(2);
        return view('backend.admin.permission.index', compact('permissions', 'breadcrumbs'));
    } 

    public function create() {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách quyền người dùng', 'url' => route('admin.permission.index')],      
            ['name' => 'Tạo mới quyền người dùng', 'url' => route('admin.permission.create')],      
        ];
        return view('backend.admin.permission.create', compact('breadcrumbs'));        
    }

    public function store(PermissionRequest $request) {
        $permission_name = trim($request->name);
        $save = Permission::create(['name' => $permission_name]);
        if($save) {
            return redirect()->route('admin.permission.index')->with('success', 'Thêm mới quyền người dùng thành công.');
        }
        return redirect()->route('admin.permission.index')->with('error', 'Thêm mới quyền người dùng thất bại. Vui lòng thử lại');
    }


    public function edit($id = '') {
        $permission = Permission::find($id);
        $roles = Role::all();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách quyền người dùng', 'url' => route('admin.permission.index')],      
            ['name' => 'Chỉnh sửa quyền trò người dùng', 'url' => route('admin.permission.edit', $permission->id)],      
        ];
        return view('backend.admin.permission.edit', compact('permission', 'breadcrumbs', 'roles'));
    }

    public function update(PermissionRequest $request , $id = '') {
        $permission = Permission::find($id);
        $permission_name = trim($request->name);
        $update = $permission->update(['name' => $permission_name]);
        if($update) {
            return redirect()->route('admin.permission.index')->with('success', 'Cập nhập quyền người dùng thành công.');
        }
        return redirect()->route('admin.permission.index')->with('error', 'Cập nhập quyền người dùng thất bại. Vui lòng thử lại');
    }


    public function delete($id = '') {
        $permission = Permission::find($id);
       
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách quyền người dùng', 'url' => route('admin.role.index')],      
            ['name' => 'Xóa quyền người dùng', 'url' => route('admin.role.delete', $permission->id)],      
        ];
        return view('backend.admin.permission.delete', compact('permission', 'breadcrumbs'));
    }

    public function destroy(Request $request , $id = '') {
        $permission = Permission::find($id);
        $permission_name = trim($request->name);
        $destroy = $permission->delete(['name' => $permission_name]);
        if($destroy) {
            return redirect()->route('admin.permission.index')->with('success', 'Xóa quyền người dùng thành công.');
        }
        return redirect()->route('admin.permission.index')->with('error', 'Xóa quyền người dùng thất bại. Vui lòng thử lại');
    }
}