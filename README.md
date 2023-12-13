# integracao-mp

## requirementos
* composer e sdk MP  :  siga  o  passo a passo  na documentacao https://github.com/mercadopago/sdk-php
* documentacao e configuiracao inicial https://www.mercadopago.com.br/developers/pt/docs/checkout-api/landing
  # Configuracao API PIX cartao etc..
  * faca seu formulario capturando as informacoes ou use  ja pronta  disponibilizado pela Mercado pago https://www.mercadopago.com.br/developers/pt/docs/checkout-api/landing
  * nao esqueca  de  referenciar op SDK  javascript e  deixar ja instalado Via composer  caso contrario  nao  iara funcionar siga  documentacao https://github.com/mercadopago/sdk-php
  * no arquivo javascript vc tera uma requicao fetch para api.php  edite conforme  sua nescessidade.
  * feita requicao no php ele retornara um JSON  copm os dados QR code em base64  e outras informacoes  de  inicio as mais importantes sao estas QR  e ID de pagamento
  * parsei o json e use os dados  comforme  sua nescesidade no caso  PIX  redenizei QR na tela
    ## Notificação WebHook
  * no painel MP  configure Webhook para receber a notificaçao, e nao se esqueca de entregar status 200, nao se apegue  que  o padrao e 200  e obrigatorio devolver status 200, conforme na linha 17  notificacao.php
  * feito tudo coretamente assim  que receber  msg   de  aprovado  na notificaçao basta imprementar sua logica 
