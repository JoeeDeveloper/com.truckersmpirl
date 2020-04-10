<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use App\User;
use File;
use Illuminate\Contracts\Session\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(){

        $users = User::all();
        $houses = ['Bowes','Dale','Durham','Longfield','Marwood','North','Tees','York'];
        $genders = ['Male', 'Female', 'Other'];
        $years = ['10', '11'];

        return view('admin.users.index', compact('users', 'houses', 'genders', 'years'));
    }

    public function admin_edit($id) {
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->getrolenames()[0];


        $houses = ['Bowes', 'Dale', 'Durham', 'Longfield', 'Marwood', 'North', 'Tees', 'York'];
        $genders = ['Male', 'Female', 'Other'];
        $years = ['10', '11'];


        return view('admin.users.edituser', compact('user', 'houses', 'genders', 'years', 'roles', 'userRole'));
    }

    public function update(Request $request, User $user){

        $user->email = $request->email;
        $user->name = $request->name;
        $user->currentYear = $request->currentYear;
        $user->House = $request->house;
        $user->Merits = $request->merits;
        $user->Gender = $request->gender;
        $user->syncRoles($request->role);

        $user->save();

        return view('home');
    }

    public function removeAvatar(Request $request, User $user){
        $user->avatar = 'default.png';
        $user->save();
        $request->session()->flash('status','Task was suceessful"');

        redirect view('')->with('successBanner', 'Successfully removed the avatar!');
    }

    public function profile(User $user){
        return view('profile', [
            'profileUser' => $user
        ]);
    }

    public function edit(){
        return view('edit-profile', array('user' => Auth::user() ));

    }

    public function updateAvatar(Request $request){
        $avatar = $request->file('avatar');
        $user = Auth::user();
        $filename = 'avatar_' . Auth::user()->name . '_' . Auth::user()->id .'_' .  time() . '.' . $avatar->getClientOriginalExtension();
        $user->avatar = $filename;

        if($request->hasFile('avatar')){

            if($user->avatar !== 'default.png') {
                $file = public_path('/public/user-assets/avatars/current/' . $user->avatar);

                if (File::exists($file)) {
                    rename('/public/user-assets/avatars/current/' . $user->avatar, '/public/user-assets/avatars/archive/' . 'archive_' . $filename);
                };
            };

            Image::make($avatar)->resize(300, 300)->save(public_path('/user-assets/avatars/current/' . $filename));

            $user->save();

            return redirect('/profile/edit');
        }
    }
}
