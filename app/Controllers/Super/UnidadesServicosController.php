<?php

namespace App\Controllers\Super;

use App\Repositories\UnidadeRepository;
use App\Repositories\ServicoRepository;
use App\Repositories\UnidadeServicoRepository;
use Core\Controller;

/**
 * UnidadesServicosController
 * ─────────────────────────────────────────────────────────────────────────────
 * Responsável por receber as requisições HTTP, delegar para o Service/Repository
 * e retornar a resposta adequada (View ou JSON).
 *
 * Regra: controllers devem ser finos.
 * Lógica de negócio → Service | Acesso a dados → Repository
 */
class UnidadesServicosController extends Controller
{

    /**
     * @var UnidadeRepository
     */
    private UnidadeRepository $unidadeModel;
    private UnidadeServicoRepository $vinculoRepository;
    private ServicoRepository $servicoRepository;

    public function __construct()
    {
        // parent::__construct() já instancia o Request automaticamente,
        parent::__construct();

        // Inicialize dependências aqui
        $this->unidadeModel = new UnidadeRepository();
        $this->servicoRepository = new ServicoRepository();
        $this->vinculoRepository = new UnidadeServicoRepository();
    }

    /**
     * Gerenciar os serviços das unidades
     */
    public function servicos(int $unidadeId): void
    {
        $unidade = $this->unidadeModel->findById($unidadeId);

        $data = [
            'title'   => 'Gerenciar serviços da unidade',
            'unidade' => $unidade,
            'servicos'         => $this->servicoRepository->all(),
            'servicoIdsAtivos' => $this->vinculoRepository->getServicoIds($unidadeId),
        ];

        $this->view('back.unidades.servicos', $data, 'main');
    }

    /**
     * Salva os serviços marcados (checkboxes) para a unidade.
     * POST /super/unidade/{unidadeId}/servicos
     */
    public function atualizarServicos(int $unidadeId): void
    {
        $unidade = $this->unidadeModel->findById($unidadeId);

        $this->abortUnless((bool) $unidade, 404);

        // Nomes vindos do input name="servicos[]" no formulário
        $servicoIds = $_POST['servicos'] ?? [];

        $this->vinculoRepository->sync($unidadeId, $servicoIds);

        $this->redirectWith(
            "super/unidade/",
            'success',
            'Serviços da unidade atualizados com sucesso!'
        );
    }
}
