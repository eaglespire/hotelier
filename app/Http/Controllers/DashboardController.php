<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\FileManager;
use App\Models\RoomCategory;
use App\Models\User;
use App\Traits\ImageStore;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Bouncer;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DashboardController extends BaseController
{
    use ImageStore;
    public function index()
    {
        $this->data['title'] = 'Admin';
        $this->data['titleDesc'] = 'Admin Backend to manage hotel CRM';
        $this->data['description'] = 'Welcome to hotelier';
        return view('admin.index', $this->data);
    }
    public function users()
    {
        $this->data['title'] = 'Users';
        $this->data['titleDesc'] = 'Manage Users';
        $this->data['description'] = 'User Management';
        return view('admin.users.index', $this->data);
    }
    public function editUser(User $user)
    {
        $this->data['title'] = 'Edit User';
        $this->data['titleDesc'] = 'Manage Users';
        $this->data['description'] = 'User Management';
        $this->data['user'] = $user;
        return view('admin.users.edit', $this->data);
    }
    public function roles()
    {
        $this->data['title'] = 'Application Roles';
        $this->data['titleDesc'] = 'View Application Roles';
        $this->data['description'] = 'View Application Roles';
        return view('admin.roles.index', $this->data);
    }
    public function editRole(int $id)
    {
        $role = DB::table('roles')->where('id',$id)->first();
        $this->data['role'] = $role;
        $this->data['title'] = 'Edit User';
        $this->data['titleDesc'] = 'Manage Users';
        $this->data['description'] = 'User Management';
        return view('admin.roles.edit-role', $this->data);
    }
    public function permissions()
    {
        $this->data['title'] = 'Application Permissions';
        $this->data['titleDesc'] = 'View Application Permissions';
        $this->data['description'] = 'View Application Permissions';
        return view('admin.permissions.index', $this->data);
    }
    public function allStaff()
    {
        $this->data['title'] = 'Manage Staff';
        $this->data['titleDesc'] = 'View Employees';
        $this->data['description'] = 'View Employees';
        return view('admin.staff.index', $this->data);
    }
    public function staff($staffNumber)
    {
        $staff = Employee::where('staff_number',$staffNumber)->first();
        $roles = DB::table('roles')->get();
        $this->data['roles'] = $roles;
        $this->data['title'] = $staff->user->fullname;
        $this->data['titleDesc'] = 'Manage Staff';
        $this->data['description'] = 'Manage Staff';
        $this->data['staff'] = $staff;
        return view('admin.staff.show', $this->data);
    }
    public function updateStaff(Request $request)
    {
        $request->validate([
            'firstname' => ['required','string','max:255'],
            'lastname' => ['required','string','max:255'],
            'age' => ['required','numeric','min:1','max:255'],
            'city' => ['nullable','string','max:255'],
            'street' => ['nullable','string','max:255'],
            'state' => ['nullable','string','max:255'],
            'country' => ['nullable','string','max:255'],
            'zip' => ['nullable','numeric'],
            'photo' => ['nullable','image','max:300']
        ]);

        //get the staff to update
        try {
            //upload the image
            $src = $this->upload('photo',128,128);
            $staff = Employee::findOrFail(request('user_id'));
            $staff->user()->update([
                'firstname'=> $request['firstname'],
                'lastname' => $request['lastname']
            ]);
            Bouncer::retract($staff->user->getRoles()->first())->from($staff->user); //retracts the previous role from this user
            $staff->update([
                'city' => $request['city'],
                'street' => $request['street'],
                'state' => $request['state'],
                'country' => $request['country'],
                'role' => $request['role'],
                'zip' => $request['zip'],
                'age' => $request['age'],
                'doe' => $request['doe'] !== null ? Carbon::parse($request['doe']) : $staff->doe,
                'photo' => $src,
                'gender' => $request['gender']
            ]);
            $staff->update([
                'staff_number' => Str::staff($request['age'],$staff->doe,$request['role'])
            ]);

            //assign a new role to the user
            Bouncer::assign(request('role'))->to($staff->user);
            toast('Success','success');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('Something went wrong','error');
        }
           return redirect(route('usr.all-staff'));
    }
    public function OpenFileManager()
    {
        $this->data['title'] = 'File Manager';
        $this->data['titleDesc'] = 'File Manager';
        $this->data['description'] = 'File Manager';
        return view('admin.file-manager.index', $this->data);
    }
    public function FileManager(string $folder)
    {
        $this->data['title'] = "$folder";
        $this->data['titleDesc'] = "$folder";
        $this->data['description'] = "$folder";
        $this->data['folder'] = $folder;
        return view('admin.file-manager.show', $this->data);
    }
    public function log()
    {
        $this->data['title'] = 'User Activities';
        $this->data['titleDesc'] = 'User Activities';
        $this->data['description'] = 'User Activities';
        return view('admin.log.index', $this->data);
    }
}
