<?php

namespace App\Controllers\Super;

use App\Controllers\BaseController;
use Core\Session;



/**
 * HomeController
 * ─────────────────────────────────────────────────────────────────────────────
 * Responsável por receber as requisições HTTP, delegar para o Service/Repository
 * e retornar a resposta adequada (View ou JSON).
 *
 * Regra: controllers devem ser finos.
 * Lógica de negócio → Service | Acesso a dados → Repository
 */
class HomeController extends BaseController
{
    public function __construct()
    {
        // parent::__construct() já instancia o Request automaticamente,
        // disponível em $this->request — não é necessário criá-lo manualmente
        parent::__construct();

        // Inicialize dependências aqui
        // $this->repository = new HomeRepository();
    }

    /**
     * Lista todos os registros.
     * GET /home
     */
    public function index(): void
    {
        $data = [
            'title' => 'Área Administrativa',
            'subtitle'  => 'Área do Super Administrador',
        ];

        $this->view(
            'back.home.index',
            $data,
            'main'
        );
    }

    /**
     * Exibe um registro específico.
     * GET /home/{id}
     */
    public function show(int $id): void
    {
        // $item = $this->repository->findById($id);
        // $this->abortUnless((bool)$item, 404);

        $this->view('home.show', [
            'title' => 'Detalhes',
            // 'item'  => $item,
        ]);
    }

    /**
     * Exibe o formulário de criação.
     * GET /home/create
     */
    public function create(): void
    {
        $this->view('home.create', [
            'title' => 'Novo Home',
        ]);
    }

    /**
     * Processa a criação de um novo registro.
     * POST /home
     */
    public function store(): void
    {
        // Exemplo com FormRequest:
        // $request = new StoreHomeRequest();
        // if ($request->fails()) {
        //     Session::flash('error', $request->firstError());
        //     Session::flashInput($request->all());
        //     $this->back();
        // }
        // $data = $request->validated();

        // Exemplo com validate() inline:
        $this->validate($_POST, [
            'name' => 'required|min:2|max:100',
        ]);

        // $id = $this->repository->create($_POST);
        $this->redirectWith('home', 'success', 'Home criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição.
     * GET /home/{id}/edit
     */
    public function edit(int $id): void
    {
        // $item = $this->repository->findById($id);
        // $this->abortUnless((bool)$item, 404);

        $this->view('home.edit', [
            'title' => 'Editar Home',
            // 'item'  => $item,
        ]);
    }

    /**
     * Processa a atualização de um registro.
     * PUT /home/{id}
     */
    public function update(int $id): void
    {
        $this->validate($_POST, [
            'name' => 'required|min:2|max:100',
        ]);

        // $this->repository->update($id, $_POST);
        $this->redirectWith('home', 'success', 'Home atualizado com sucesso!');
    }

    /**
     * Remove um registro.
     * DELETE /home/{id}
     */
    public function destroy(int $id): void
    {
        // $item = $this->repository->findById($id);
        // $this->abortUnless((bool)$item, 404);
        // $this->repository->delete($id);

        $this->jsonSuccess('Home removido com sucesso.');
    }
}
