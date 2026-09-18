<?php

namespace App\Controllers\Super;

use Core\Controller;
use Core\Session;
use App\Repositories\ServicoRepository;
use App\Requests\Servico\StoreServicoRequest;
use App\Requests\Servico\UpdateServicoRequest;

/**
 * ServicosController
 * ─────────────────────────────────────────────────────────────────────────────
 * Responsável por receber as requisições HTTP, delegar para o Service/Repository
 * e retornar a resposta adequada (View ou JSON).
 *
 * Regra: controllers devem ser finos.
 * Lógica de negócio → Service | Acesso a dados → Repository
 */
class ServicosController extends Controller
{
    protected ServicoRepository $servicoModel;

    public function __construct()
    {
        // parent::__construct() já instancia o Request automaticamente,
        parent::__construct();

        // Inicialize dependências aqui
        $this->servicoModel = new ServicoRepository();
    }

    /**
     * Lista todos os registros.
     * GET /servicos
     */
    public function index(): void
    {
        $data = [
            'title' => 'Serviços',
            'subtitle'  => 'Lista de Serviços',
            'servicos' => $this->servicoModel->all(),
        ];

        $this->view(
            'back.servicos.index',
            $data,
            'main'
        );
    }

    /**
     * Exibe um registro específico.
     * GET /Serviço/{id}
     */
    public function show(int $id): void
    {
        $servicos = $this->servicoModel->findById($id);

        if (!$servicos) {
            $this->redirect('/super/servico');
        }

        $data = [
            'title'    => 'Detalhes da Unidade',
            'servicos' => $servicos,
        ];

        $this->view(
            'back.servicos.show',
            $data,
            'main'
        );
    }

    /**
     * Exibe o formulário de criação.
     * GET /Serviço/create
     */
    public function create(): void
    {
        $data = [
            'title' => 'Novo Serviço',
        ];

        $this->view(
            'back.servicos.create',
            $data,
            'main'
        );
    }

    /**
     * Processa a criação de um novo registro.
     * POST /Serviço
     */
    public function store(StoreServicoRequest $request): void
    {
        if ($request->fails()) {
            Session::flash('error', $request->firstError());
            Session::flashErrors($request->errors());
            Session::flashInput($request->all());

            $this->back();
            return;
        }

        $data = $request->validated();

        $id = $this->servicoModel->create($data);

        if (!$id) {
            $this->redirectWith('super/servico', 'error', 'Não foi possível criar a unidade.');
            return;
        }

        $this->redirectWith('super/servico', 'success', 'Unidade criada com sucesso!');
    }

    /**
     * Exibe o formulário de edição.
     * GET /Serviço/{id}/edit
     */
    public function edit(int $id): void
    {
        $servicos = $this->servicoModel->findById($id);

        if (!$servicos) {
            $this->redirect('/super/servico');
        }

        $data = [
            'title' => 'Editar Serviço',
            'servicos' => $this->servicoModel->findById($id),
        ];

        $this->view('back.servicos.edit', $data, 'main');
    }

    /**
     * Processa a atualização de um registro.
     * PUT /Serviço/{id}
     */
    public function update(UpdateServicoRequest $request, int $id): void
    {
        if ($request->fails()) {
            Session::flash('error', $request->firstError());
            Session::flashErrors($request->errors());
            Session::flashInput($request->all());

            $this->back();
            return;
        }

        $data    = $request->validated();

        $updated = $this->servicoModel->update($id, $data);

        if (!$updated) {
            $this->redirectWith(
                'super/servico',
                'error',
                'Não foi possível atualizar a unidade.'
            );
            return;
        }

        $this->redirectWith(
            'super/servico',
            'success',
            'Unidade atualizada com sucesso!'
        );
    }

    /**
     * Remove um registro.
     * DELETE /Serviço/{id}
     */
    public function destroy(int $id): void
    {
        $servico = $this->servicoModel->findById($id);
        $this->abortUnless((bool)$servico, 404);

        $this->servicoModel->delete($id);

        $this->redirectWith('super/servico', 'success', 'Unidade removida com sucesso.');
    }

    /**
     * Alterna o status de um registro (Ativar/Desativar).
     * POST /Serviço/{id}/ver-status
     */
    public function verStatus(int $id): void
    {
        $servico = $this->servicoModel->findById($id);
        $this->abortUnless((bool)$servico, 404);

        $atualizado = $this->servicoModel->verStatus($id);

        if (!$atualizado) {
            $this->redirectWith('super/servico', 'error', 'Não foi possível alterar o status da unidade.');
            return;
        }

        $mensagem = ((int)$servico->status === 1)
            ? 'Serviço desativada com sucesso!'
            : 'Serviço ativada com sucesso!';

        $this->redirectWith('super/servico', 'success', $mensagem);
    }
}
