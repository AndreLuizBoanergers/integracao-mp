<?php
session_start();
extract($_GET);
$_SESSION['nome'] = $_GET['nome'];
$_SESSION['sobre'] = $_GET['sobre'];
$_SESSION['email'] = $_GET['email'];
$_SESSION['cpf'] = $_GET['cpf'];
$_SESSION['valor'] = $_GET['valor'];
$_SESSION['cel'] = $_GET['cel'];
$_SESSION['qtd'] = $_GET['qtd'];
$amout = $_GET['valor'];
$email = $_GET['email'];
$cpf = $_GET['cpf'];
$nome = $_GET['nome'];
$sobrenome = $_GET['sobre'];
$email = $_GET['email'];
$telefone = $_GET['cel'];
$qtd = $_GET['qtd'];
$post = '{
      "transaction_amount": '.$amout.',
      "description": "Título do produto",
      "payment_method_id": "pix",
      "payer": {
        "email": '.$email.',
        "first_name": '.$nome.',
        "last_name": '.$sobrenome.',
        "identification": {
            "type": "CPF",
            "number": '.$cpf.'
        },
        "address": {
            "zip_code": "06233200",
            "street_name": "Av. das Nações Unidas",
            "street_number": "3003",
            "neighborhood": "Bonfim",
            "city": "Osasco",
            "federal_unit": "SP"
        }
      }
    }';
$ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payments');
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'accept: application/json',
      'content-type: application/json',
      'Authorization: Bearer TEST-xxxxxx-082121-4c3f271dead4147b86b225e552ff9d7c-xxxxxx'
   ));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
file_put_contents("resp.txt", $response);
echo $response;
