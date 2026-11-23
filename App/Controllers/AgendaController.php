<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\ErrorHandler;
use App\Services\TaskService;
use Exception;

final class AgendaController extends Controller 
{

    use ErrorHandler;

    protected TaskService $service;

    public function __construct()
    {
        $this->service = new TaskService;
    }

    public function index(): void
    {


        $this->view('layouts/header',['title'=>'Agenda']);
        $this->view('agenda/agenda', $this->build_data());
    }

    private function month_tasks(){
        ['mes' => $mes, 'ano' => $ano] = $this->lerMesAno($_GET);

        try{
            return $this->service->get_task_mes((string)$ano,(string)$mes);
        }catch(Exception $e){
            self::handler(500,$e->getMessage());
        }
        
    }

    private function build_data():array{
        
        ['mes' => $mes, 'ano' => $ano] = $this->lerMesAno($_GET);

        $hoje       = $this->dataHoje();
        $diasSemana = $this->diasSemana();
        $tituloMes  = $this->tituloMes($mes, $ano);
        $semanas    = $this->gerarSemanas($mes, $ano, $hoje);

        $links         = $this->linksNavegacao($mes, $ano);
        $linkAnterior  = $links['anterior'];
        $linkProximo   = $links['proximo'];
        $tasksDoMes = $this->month_tasks();

        return [
            'linkAnterior' => $linkAnterior,
            'linkProximo' => $linkProximo,
            'tituloMes' => $tituloMes,
            'diasSemana' => $diasSemana,
            'semanas' => $semanas,
            'tasksDoMes'=>$tasksDoMes
        ];
    }

    private function lerMesAno(array $get): array
    {
        $mes = isset($get['mes']) ? (int) $get['mes'] : (int) date('n');
        $ano = isset($get['ano']) ? (int) $get['ano'] : (int) date('Y');

        $base = mktime(0, 0, 0, $mes, 1, $ano);

        return [
            'mes' => (int) date('n', $base),
            'ano' => (int) date('Y', $base),
        ];
    }

    private function dataHoje(): string
    {
        return date('Y-m-d');
    }

    private function nomesMeses(): array
    {
        return [1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    }

    /**
    * Cabeçalho da tabela (Dom a Sáb).
    */
    private function diasSemana(): array
    {
        return ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
    }

    /**
     * Título exibido no topo. Ex.: "Novembro de 2026".
     */
    private function tituloMes(int $mes, int $ano): string
    {
        return $this->nomesMeses()[$mes] . ' de ' . $ano;
    }

    /**
     * Quantos dias o mês tem (28 a 31).
     */
    private function diasNoMes(int $mes, int $ano): int
    {
        return (int) date('t', mktime(0, 0, 0, $mes, 1, $ano));
    }

    /**
     * Em que dia da semana o dia 1 cai (0 = domingo ... 6 = sábado).
     */
    private function diaSemanaInicio(int $mes, int $ano): int
    {
        return (int) date('w', mktime(0, 0, 0, $mes, 1, $ano));
    }

    /**
     * Links de navegação para o mês anterior e o próximo.
     *
     * @return array ['anterior' => string, 'proximo' => string]
     */
    private function linksNavegacao(int $mes, int $ano): array
    {
        $anterior = mktime(0, 0, 0, $mes - 1, 1, $ano);
        $proximo  = mktime(0, 0, 0, $mes + 1, 1, $ano);

        return [
            'anterior' => '?mes=' . date('n', $anterior) . '&ano=' . date('Y', $anterior),
            'proximo'  => '?mes=' . date('n', $proximo)  . '&ano=' . date('Y', $proximo),
        ];
    }

    /**
     * Lista de células do mês, na ordem da grade:
     * vazias antes do dia 1, os dias, e vazias para fechar a última semana.
     *
     * Cada célula é null (vazia) ou
     * ['dia' => 5, 'data' => '2026-11-05', 'hoje' => false]
     */
    private function gerarCelulas(int $mes, int $ano, string $hoje): array
    {
        $celulas = [];

        // Vazias antes do dia 1
        for ($i = 0; $i < $this->diaSemanaInicio($mes, $ano); $i++) {
            $celulas[] = null;
        }

        // Dias do mês
        $total = $this->diasNoMes($mes, $ano);
        for ($dia = 1; $dia <= $total; $dia++) {
            $data = sprintf('%04d-%02d-%02d', $ano, $mes, $dia);

            $celulas[] = [
                'dia'  => $dia,
                'data' => $data,
                'hoje' => ($data === $hoje),
            ];
        }

        // Vazias para fechar a última semana
        while (count($celulas) % 7 !== 0) {
            $celulas[] = null;
        }

        return $celulas;
    }

    /**
     * Agrupa as células em semanas de 7.
     *
     * @return array lista de semanas (cada semana = array de 7 células)
     */
    private function gerarSemanas(int $mes, int $ano, string $hoje): array
    {
        return array_chunk($this->gerarCelulas($mes, $ano, $hoje), 7);
    }

}