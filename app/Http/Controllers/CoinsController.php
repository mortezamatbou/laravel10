<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoinsStoreRequest;
use App\Http\Requests\CoinsUpdateRequest;
use App\Models\Coins;
use App\Models\User;
use App\Repositories\CoinsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class CoinsController extends Controller
{

    private CoinsRepository $coins;

    function __construct()
    {
        $this->coins = new CoinsRepository(new Coins());
    }

    public function login_form(): View
    {
        $title = 'Login';
        return view('coins.login', compact('title'));
    }

    public function login_check(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            // login successfully
            $request->session()->regenerate();
            return redirect()->intended('/coins');
        }

        // else, username or password is invalid
        return back()->withErrors([
            'email' => 'Username or Password is invalid'
        ])->onlyInput('email');
    }

    public function login_success(Request $request): void
    {
        $id = Auth::id();
        $user = Auth::user();
    }

    public function index(): View
    {

//        $users = User::with('roles')->role('viewer')->get();
//        $users = User::doesntHave('roles')->get();
//
//        foreach ($users as $user) {
//            echo "$user->id $user->name $user->email<br>";
//        }
//        exit;
//
//        $user = User::where('id', 7)->first();
//        pre_print($user->getAllPermissions());
//        /**
//         * @var $permission Permission
//         */
//        $permission = $user->getPermissionsViaRoles()[1];
//        pre_print($permission->guard_name);

        $coins = $this->coins->all();
        $title = 'Coins';

        return view('coins.list', compact('coins', 'title'));
    }

    public function detail(Request $request, string $id): View
    {
        $coin = $this->coins->find($id);
        return view('coins.coin_detail', compact('coin'))->with('title', "Detail of $coin->symbol");
    }

    public function coin_update(CoinsUpdateRequest $request, string $id)
    {
        // $data = $request->except('_token');
//        $data = [
//            'title' => $request->post('title'),
//            'symbol' => $request->post('symbol')
//        ];

        $data = $request->validated();
        $this->coins->update($data, $id);
        return to_route('coins.detail', ['id' => $id]);
    }

    public function coin_add_form(): View
    {
        return view('coins.coin_add')->with('title', 'Add new coin');
    }

    public function coin_add(CoinsStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $id = $this->coins->create($data);
        return to_route('coins.detail', ['id' => $id]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('coins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('coins.login.form');
    }

}
