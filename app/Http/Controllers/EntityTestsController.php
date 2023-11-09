<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EntityTestCreateRequest;
use App\Http\Requests\EntityTestUpdateRequest;
use App\Repositories\EntityTestRepository;
use App\Validators\EntityTestValidator;

/**
 * Class EntityTestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EntityTestsController extends Controller
{
    /**
     * @var EntityTestRepository
     */
    protected $repository;

    /**
     * @var EntityTestValidator
     */
    protected $validator;

    /**
     * EntityTestsController constructor.
     *
     * @param EntityTestRepository $repository
     * @param EntityTestValidator $validator
     */
    public function __construct(EntityTestRepository $repository, EntityTestValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index(): View
    {
        // $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $entities = $this->repository->all();
        return view('entities.entities', compact('entities'));
    }

    public function store_form(): View
    {
        return view('entities.add', ['title' => 'Add new Entity']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EntityTestCreateRequest $request
     * @return RedirectResponse
     */
    public function store(EntityTestCreateRequest $request): RedirectResponse
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data = $request->except('_token');

            $entity = $this->repository->create_id($data);

            $response = [
                'message' => 'Entity created.',
                'data' => $entity->toArray(),
            ];

            // return redirect()->back()->with('message', $response['message']);
            return to_route('entity.detail', ['id' => $entity->id]);
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $id): View
    {
        $entity = $this->repository->find($id);
        $title = $entity->firstName . ' ' . $entity->lastName;
        return view('entities.show', compact('entity', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EntityTestUpdateRequest $request
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function update(EntityTestUpdateRequest $request, string $id): RedirectResponse
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $data = $request->except('_token');

            $entityTest = $this->repository->update($data, $id);
            $response = [
                'message' => 'Entity updated.',
                'data' => $entityTest->toArray(),
            ];
            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back()->with('message', 'Entity deleted.');
    }
}
