<?php

namespace App\Http\Controllers\Backend\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Http\Requests\UpdatePermissionRoleRequest;
use DB;

class RoleController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách vai trò người dùng', 'url' => route('admin.role.index')],      
        ];
        $roles = Role::paginate(2);
        return view('backend.admin.roles.index', compact('roles', 'breadcrumbs'));
    } 

    public function create() {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách vai trò người dùng', 'url' => route('admin.role.index')],      
            ['name' => 'Tạo mới vai trò trò người dùng', 'url' => route('admin.role.create')],      
        ];
        return view('backend.admin.roles.create', compact('breadcrumbs'));        
    }

    public function store(RolesRequest $request) {
        $role_name = trim($request->name);
        $save = Role::create(['name' => $role_name]);
        if($save) {
            return redirect()->route('admin.role.index')->with('success', 'Thêm mới vai trò người dùng thành công.');
        }
        return redirect()->route('admin.role.index')->with('error', 'Thêm mới vai trò người dùng thất bại. Vui lòng thử lại');
    }

    public function edit($id = '') {
        $role = Role::find($id);
        $permissions = Permission::all();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách vai trò người dùng', 'url' => route('admin.role.index')],      
            ['name' => 'Chỉnh sửa vai trò trò người dùng', 'url' => route('admin.role.edit', $id)],      
        ];
        return view('backend.admin.roles.edit', compact('role', 'breadcrumbs', 'permissions'));
    }

    public function update(RolesRequest $request , $id = '') {
        $role = Role::find($id);
        $role_name = trim($request->name);
        $update = $role->update(['name' => $role_name]);
        if($update) {
            return redirect()->route('admin.role.index')->with('success', 'Cập nhập vai trò người dùng thành công.');
        }
        return redirect()->route('admin.role.index')->with('error', 'Cập nhập vai trò người dùng thất bại. Vui lòng thử lại');
    }

    public function delete($id = '') {
        $role = Role::find($id);
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách vai trò người dùng', 'url' => route('admin.role.index')],      
            ['name' => 'Xóa vai trò người dùng', 'url' => route('admin.role.delete', $role->id)],      
        ];
        return view('backend.admin.roles.delete', compact('role', 'breadcrumbs'));
    }

    public function destroy(Request $request , $id = '') {
        $role = Role::find($id);
        $role_name = trim($request->name);
        $destroy = $role->delete(['name' => $role_name]);
        if($destroy) {
            return redirect()->route('admin.role.index')->with('success', 'Xóa vai trò người dùng thành công.');
        }
        return redirect()->route('admin.role.index')->with('error', 'Xóa vai trò người dùng thất bại. Vui lòng thử lại');
    }


    public function assignPermission(Request $request , $roleId = '') {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $roles_has_permissions = DB::table('role_has_permissions')
                                    ->where('role_has_permissions.role_id', $role->id)
                                    ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                    ->all();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách vai trò người dùng', 'url' => route('admin.role.index')],      
            ['name' => 'Gán quyền cho vai trò người dùng', 'url' => route('admin.role.permissions', $roleId)],      
        ];
        return view('backend.admin.roles.add-permission' , compact('role', 'breadcrumbs', 'permissions', 'roles_has_permissions'));
    }


    public function updatePermission(UpdatePermissionRoleRequest $request, $roleId = '') {
        $role = Role::findOrFail($roleId);
        
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('success', 'Gán quyền cho vai trò thành công.');
    }

}