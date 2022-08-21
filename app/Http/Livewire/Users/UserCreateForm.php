<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserCreateForm extends Component
{
    public $roles;
    public $first_name;
    public $second_name;
    public $last_name;
    public $email;
    public $picture;
    public $password;
    public $selectedRoles;

    public function mount()
    {
        $this->roles = Role::query()->where('name', '!=', 'super-admin')->pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.users.user-create-form');
    }

    public function create()
    {
        DB::beginTransaction();
        try {
            $user = User::query()->create([
                'name' => $this->first_name . ' ' . $this->second_name . ' ' . $this->last_name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            if ($this->picture) {
                $user->addMedia($this->picture)->toMediaCollection('picture');
            }

            $user->syncRoles($this->selectedRoles);

            DB::commit();

            Alert::success('success', 'Record created successfully');

            return redirect()->route('dashboard.users.index');
        } catch (Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Something went wrong please try again');
            return redirect()->route('dashboard.users.index');
        }
    }
}
