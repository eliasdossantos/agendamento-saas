<?php

namespace App\Controllers\Super;

use App\Models\UnidadeModel;
use App\Controllers\BaseController;
use Core\Session;
use App\Repositories\UnidadeRepository;
use App\Repositories\UnidadeServicoRepository;
use App\Requests\Unidade\UpdateUnidadeRequest;
use App\Requests\Unidade\StoreUnidadeRequest;
use Core\Upload;


/**
 * UnidadesController
 * ─────────────────────────────────────────────────────────────────────────────
 * Responsável por receber as requisições HTTP, delegar para o Service/Repository
 * e retornar a resposta adequada (View ou JSON).
 *
 * Regra: controllers devem ser finos.
 * Lógica de negócio → Service | Acesso a dados → Repository
 */
class UnidadesController extends BaseController
{
    protected UnidadeRepository $repository;
    protected UnidadeServicoRepository $vinculoRepository;

    public function __construct()
    {
        // parent::__construct() já instancia o Request automaticamente,
        parent::__construct();

        $this->repository = new UnidadeRepository();
        $this->vinculoRepository = new UnidadeServicoRepository();
    }

    /**
     * Lista todos os registros.
     * GET /unidades
     */
    public function index(): void
    {

        $data = [
            'title' => 'Unidades',
            'subtitle'  => 'Lista de Unidades',
            'unidades' => $this->repository->all(),
            'servicosPorUnidade' => $this->vinculoRepository->getNomesAgrupadosPorUnidade(),
        ];

        $this->view(
            'back.unidades.index',
            $data,
            'main'
        );
    }

    /**
     * Exibe um registro específico.
     * GET /unidades/{id}
     */
    public function show(int $id): void
    {
        $unidades = $this->repository->findById($id);
        $this->abortUnless((bool) $unidades, 404, 'Unidade não encontrada.');

        $data = [
            'title'    => 'Detalhes da Unidade',
            'unidades' => $unidades,
        ];

        $this->view(
            'back.unidades.show',
            $data,
            'main'
        );
    }

    /**
     * Exibe o formulário de criação.
     * GET /unidades/create
     */
    public function create(): void
    {
        $data = [
            'title' => 'Novo Unidades',
            'intervalos' => UnidadeRepository::getIntervalosMinutos(),
        ];

        $this->view(
            'back.unidades.create',
            $data,
            'main'
        );
    }

    /**
     * Processa a criação de um novo registro.
     * POST /unidades
     */
    public function store(StoreUnidadeRequest $request): void
    {
        if ($request->fails()) {
            Session::flash('error', $request->firstError());
            Session::flashErrors($request->errors());
            Session::flashInput($request->all());

            $this->back();
            return;
        }

        $data = $request->validated();

        if (!empty($_FILES['imagem']['name'])) {
            $upload = new Upload($_FILES['imagem']);

            $upload
                ->forImages(5)
                ->setUploadDir(STORAGE_PATH . '/uploads/unidades');

            if (!$upload->process()) {
                Session::flash('error', $upload->getFirstError());
                Session::flashInput($request->all());
                $this->back();
                return;
            }

            $data['imagem'] = 'unidade_' . bin2hex(random_bytes(8)) . '.' . pathinfo(
                $upload->getFilename(),
                PATHINFO_EXTENSION
            );

            rename(
                STORAGE_PATH . '/uploads/unidades/' . $upload->getFilename(),
                STORAGE_PATH . '/uploads/unidades/' . $data['imagem']
            );
        }

        $id = $this->repository->create($data);

        if (!$id) {
            $this->redirectWith('super/unidade', 'error', 'Não foi possível criar a unidade.');
            return;
        }

        $this->redirectWith('super/unidade', 'success', 'Unidade criada com sucesso!');
    }

    /**
     * Exibe o formulário de edição.
     * GET /unidades/{id}/edit
     */
    public function edit(int $id): void
    {
        $unidades = $this->repository->findById($id);
        $this->abortUnless((bool) $unidades, 404, 'Unidade não encontrada para edição.');

        $data = [
            'title' => 'Editar Unidades',
            'unidades' => $unidades,
            'intervalos' => UnidadeRepository::getIntervalosMinutos(),
        ];

        $this->view('back.unidades.edit', $data, 'main');
    }

    /**
     * Processa a atualização de um registro.
     * PUT /unidades/{id}
     */
    public function update(UpdateUnidadeRequest $request, int $id): void
    {
        if ($request->fails()) {
            Session::flash('error', $request->firstError());
            Session::flashErrors($request->errors());
            Session::flashInput($request->all());

            $this->back();
            return;
        }

        $data    = $request->validated();
        $unidade = $this->repository->findById($id);

        if (!empty($_FILES['imagem']['name'])) {
            $upload = new Upload($_FILES['imagem']);

            $upload
                ->forImages(5)
                ->setUploadDir(STORAGE_PATH . '/uploads/unidades');

            if (!$upload->process()) {
                Session::flash('error', $upload->getFirstError());
                Session::flashInput($request->all());
                $this->back();
                return;
            }

            $oldFilename = $upload->getFilename();

            $extension = pathinfo($oldFilename, PATHINFO_EXTENSION);

            $newFilename = 'unidade_' . bin2hex(random_bytes(8)) . '.' . $extension;

            $oldPath = STORAGE_PATH . '/uploads/unidades/' . $oldFilename;
            $newPath = STORAGE_PATH . '/uploads/unidades/' . $newFilename;

            if (!rename($oldPath, $newPath)) {
                // Se não conseguiu renomear, remove o arquivo novo
                // para não deixar lixo no diretório.
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }

                Session::flash('error', 'Não foi possível salvar a imagem.');
                Session::flashInput($request->all());
                $this->back();
                return;
            }

            // Remove a imagem antiga somente depois
            // que o novo upload foi realizado e renomeado com sucesso.
            if (!empty($unidade->imagem)) {
                $oldPath = STORAGE_PATH . '/uploads/unidades/' . $unidade->imagem;

                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            $data['imagem'] = $newFilename;
        } else {
            // Mantém a imagem atual.
            $data['imagem'] = $unidade->imagem ?? null;
        }

        $updated = $this->repository->update($id, $data);

        if (!$updated) {
            $this->redirectWith(
                'super/unidade',
                'error',
                'Não foi possível atualizar a unidade.'
            );
            return;
        }

        $this->redirectWith(
            'super/unidade',
            'success',
            'Unidade atualizada com sucesso!'
        );
    }

    /**
     * Remove um registro.
     * DELETE /unidades/{id}
     */
    public function destroy(int $id): void
    {
        $unidade = $this->repository->findById($id);
        $this->abortUnless((bool)$unidade, 404, 'Unidade não removida.');

        // Remove a imagem do disco antes de apagar o registro.
        if (!empty($unidade->imagem)) {
            $path = STORAGE_PATH . '/uploads/unidades/' . $unidade->imagem;
            if (is_file($path)) {
                unlink($path);
            }
        }

        $this->repository->delete($id);

        $this->redirectWith('super/unidade', 'success', 'Unidade removida com sucesso.');
    }

    /**
     * Alterna o status de um registro (Ativar/Desativar).
     * POST /unidades/{id}/ver-status
     */
    public function verStatus(int $id): void
    {
        $unidade = $this->repository->findById($id);
        $this->abortUnless((bool)$unidade, 404, 'Status da unidade não alterado');

        $atualizado = $this->repository->verStatus($id);

        if (!$atualizado) {
            $this->redirectWith('super/unidade', 'error', 'Não foi possível alterar o status da unidade.');
            return;
        }

        $mensagem = ((int)$unidade->status === 1)
            ? 'Unidade desativada com sucesso!'
            : 'Unidade ativada com sucesso!';

        $this->redirectWith('super/unidade', 'success', $mensagem);
    }
}
