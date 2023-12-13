<?php
// Este é o arquivo de notificação. Por exemplo, "notificacao.php"

// Pega o conteúdo da requisição
$data = file_get_contents("php://input");

// Verifica se há dados
if ($data) {
    // Adiciona a data e hora da notificação no arquivo para fins de log
    $log = date("Y-m-d H:i:s") . ": " . $data . "\n";
    $_id = explode('"data":{"id":"', $log)[1];
    $id = explode('"},', $_id)[0];
    // Escreve no arquivo notificacoes.txt
    file_put_contents("notificacoes.txt", $id, FILE_APPEND);
    
    // Define o código de resposta HTTP para 200 OK
    http_response_code(200);  // Esta linha é opcional, já que 200 é o padrão. ops  obrigatorio devolver status 200 caso contrario o MP fara varias notificacoes
    $access_token = 'APP_USR-xxxxxxx-082121-9e7e655a98deff45fe6c6d910ca5b78b-xxxxxxx';

	// O ID do pagamento que você deseja consultar
	$payment_id = $id;

	// Endpoint para obter detalhes de um pagamento
	$url = "https://api.mercadopago.com/v1/payments/{$payment_id}";

	// Inicializa cURL
	$ch = curl_init();

	// Define as opções para a requisição
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	    "Authorization: Bearer $access_token"
	]);

	// Executa a requisição
	$response = curl_exec($ch);

	// Verifica se houve erros na requisição
	if (curl_errno($ch)) {
	    echo 'Erro na requisição: ' . curl_error($ch);
	} else {
	    // Processa a resposta
	    $response_data = json_decode($response, true);
	    if (isset($response_data['status'])) {
	        echo "Status do pagamento: " . $response_data['status'];
	        file_put_contents($response_data['status'].".txt", $response_data['status'], FILE_APPEND);
	    } else {
	        echo "Resposta: ";
	        print_r($response_data);
	    }
	}

	// Fecha a sessão cURL
	curl_close($ch);
    // Responde que tudo ocorreu bem
    echo "OK";
} else {
    // Define o código de resposta HTTP para 400 Bad Request
    http_response_code(400);  // Indica que a requisição não foi processada por falta de dados.
    
    echo "Sem dados recebidos.";
}
?>
