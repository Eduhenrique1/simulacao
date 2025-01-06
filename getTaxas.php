<?php
// Configurar o cabeçalho de resposta para JSON
header('Content-Type: application/json');

try {
    // Conexão com o banco de dados
    require 'db.php';

    // Receber os parâmetros via GET
    $mes = isset($_GET['mes']) ? intval($_GET['mes']) : 0;
    $parcelas = isset($_GET['parcelas']) ? intval($_GET['parcelas']) : 0;

    if ($mes > 0 && $parcelas > 0) {
        // Buscar a taxa correspondente no banco de dados
        $stmt = $pdo->prepare("SELECT taxa FROM taxas_credito WHERE mes = :mes AND parcelas = :parcelas LIMIT 1");
        $stmt->execute([':mes' => $mes, ':parcelas' => $parcelas]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo json_encode(['taxa' => (float) $result['taxa']]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Taxa não encontrada']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Parâmetros inválidos']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro interno no servidor', 'message' => $e->getMessage()]);
}
?>
