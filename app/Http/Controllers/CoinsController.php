<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoinsStoreRequest;
use App\Http\Requests\CoinsUpdateRequest;
use App\Models\Coins;
use App\Repositories\CoinsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoinsController extends Controller
{

    private CoinsRepository $coins;

    function __construct()
    {
        $this->coins = new CoinsRepository(new Coins());
    }

    public function index(): View
    {
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
        return to_route('coins.detail',  ['id' => $id]);
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

}
