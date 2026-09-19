<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AgendaService;
use Core\Session;

/**
 * AgendasController
 * ─────────────────────────────────────────────────────────────────────────────
 * Responsável por receber as requisições HTTP, delegar para o Service/Repository
 * e retornar a resposta adequada (View ou JSON).
 *
 * Regra: controllers devem ser finos.
 * Lógica de negócio → Service | Acesso a dados → Repository
 */
class AgendasController extends BaseController
{
    private AgendaService $agendaService;

    public function __construct()
    {
        // parent::__construct() já instancia o Request automaticamente,
        // disponível em $this->request — não é necessário criá-lo manualmente
        parent::__construct();

        $this->agendaService = new AgendaService();
    }

    /**
     * Lista todos os registros.
     * GET /agendas
     */
    public function index(): void
    {
        $data = [
            'title' => 'Criar Agendamento',
            'unidades' => $this->agendaService->renderUnidade(),
        ];

        $this->view(
            'front.agendas.index',
            $data,
            'home'
        );
    }

    /**
     * Exibe um registro específico.
     * GET /agendas/{id}
     */
    public function show(int $id): void
    {
        $data = [
            'title' => 'Detalhes',
        ];

        $this->view(
            'front.agendas.show',
            $data,
            'home'
        );
    }

    /**
     * Exibe o formulário de criação.
     * GET /agendas/create
     */
    public function create(): void
    {
        $data = [
            'title' => 'Criar Agendamento',
            'unidades' => $this->agendaService->renderUnidade(),
        ];

        $this->view(
            'front.agendas.index',
            $data,
            'home'
        );
    }

    /**
     * Processa a criação de um novo registro.
     * POST /agendas
     */
    public function store(): void
    {
        // Exemplo com FormRequest:
        // $request = new StoreAgendasRequest();
        // if ($request->fails()) {
        //     Session::flash('error', $request->firstError());
        //     Session::flashErrors($request->errors());
        //     Session::flashInput($request->all());
        //
        //     $this->back();
        //     return;
        // }
        // $data = $request->validated();

        // Exemplo com validate() inline:
        $this->validate($_POST, [
            'name' => 'required|min:2|max:100',
        ]);

        // $id = $this->repository->create($_POST);
        $this->redirectWith('agendas', 'success', 'Agendas criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição.
     * GET /agendas/{id}/edit
     */
    public function edit(int $id): void
    {
        // $item = $this->repository->findById($id);
        // $this->abortUnless((bool)$item, 404);

        $data = [
            'title' => 'Editar Agendas',
        ];

        $this->view(
            'front.agendas.edit',
            $data,
            'home'
        );
    }

    /** 
     * Processa a atualização de um registro.
     * PUT /agendas/{id}
     */
    public function update(int $id): void
    {
        // Exemplo com FormRequest:
        // $request = new UpdateAgendasRequest();
        // if ($request->fails()) {
        //     Session::flash('error', $request->firstError());
        //     Session::flashErrors($request->errors());
        //     Session::flashInput($request->all());
        //
        //     $this->back();
        //     return;
        // }
        //
        // $data = $request->validated();

        // Exemplo com validate() inline:
        $this->validate($_POST, [
            'name' => 'required|min:2|max:100',
        ]);

        // $updated = $this->repository->update($id, $_POST);
        //
        // if (!$updated) {
        //     $this->redirectWith(
        //         'agendas',
        //         'error',
        //         'Não foi possível atualizar Agendas.'
        //     );
        //     return;
        // }

        $this->redirectWith(
            'agendas',
            'success',
            'Agendas atualizado com sucesso!'
        );
    }

    /**
     * Remove um registro.
     * DELETE /agendas/{id}
     */
    public function destroy(int $id): void
    {
        // $item = $this->repository->findById($id);
        // $this->abortUnless((bool)$item, 404);
        // $this->repository->delete($id);

        $this->jsonSuccess('Agendas removido com sucesso.');
    }
}
