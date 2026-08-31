<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    # Define Base view
    protected $view = 'admin.users.';

    #Bind User model
    protected $user;

    /**
     * Defining the default constructor for controller
     *
     */
    public function __construct(
        User                        $user
    ) {
        $this->user                   = $user;
    }
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            #get all paymentUser resources
            $users = $this->user->with('roles')->where('id', '!=', 1);

            $search_name = '';
            $search_status = '';
            $search_role = '';
            $search_email = '';
            if (isset($input['search_name']) || isset($input['search_email']) || isset($input['search_status']) || isset($input['search_role'])) {
                if (isset($input['search_name'])) {
                    $search_name = $input['search_name'];
                    $users->where('name', 'LIKE', '%' . $search_name . '%');
                }
                if (isset($input['search_email'])) {
                    $search_email = $input['search_email'];
                    $users->where('email', 'LIKE', '%' . $search_email . '%');
                }
                if (isset($input['search_role'])) {
                    $search_role = $input['search_role'];
                    $users->whereHas('roles', function ($query) use ($search_role) {
                        $query->where("name", "like", "%{$search_role}%");
                    });
                }
                if (isset($input['search_status'])) {
                    $search_status = $input['search_status'];
                    $users->where('status', $search_status);
                }
            }
            if (isset($input['type'])) {

                if ($input['type'] == 'excel') {
                    $detail['lists'] = $users->orderBy('id', 'DESC')->get();
                    // return Excel::download(new UserExport($detail), 'user.xlsx');
                }
            }
            $details['lists'] = $users->orderBy('id', 'DESC')->paginate(50);

            $details['roles'] = Role::pluck('name', 'name')->all();
            return view($this->view . 'index', $details);
        } catch (\Exception $ex) {
            Log::info('Error', ['data' => $ex->getMessage()]);
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function create()
    {
        $details['roles'] = Role::pluck('name', 'name')->all();
        return view('admin.users.create', $details);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'is_admin' => 'boolean',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'boolean',
            'status' => 'required|in:active,inactive'
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
