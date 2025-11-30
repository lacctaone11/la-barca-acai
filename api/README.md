# Integração API TitansHub - Configuração

## Arquivos Criados

1. **api/create_pix.php** - Cria transações PIX via API TitansHub
2. **api/check_pix_status.php** - Verifica o status do pagamento PIX

## Configuração Necessária

### 1. Obter Credenciais da API

1. Acesse sua conta na TitansHub
2. Vá para o menu de integrações
3. Copie sua **Chave Pública** e **Chave Secreta**

### 2. Configurar as Credenciais

Edite os arquivos `api/create_pix.php` e `api/check_pix_status.php` e substitua:

```php
define('TITANSHUB_PUBLIC_KEY', 'SUA_CHAVE_PUBLICA_AQUI');
define('TITANSHUB_SECRET_KEY', 'SUA_CHAVE_SECRETA_AQUI');
```

Pelos valores reais das suas credenciais.

### 3. Configurar URLs (Opcional)

No arquivo `api/create_pix.php`, ajuste as URLs se necessário:

```php
'postbackUrl' => $baseUrl . '/api/pix_webhook.php', // URL para receber notificações
'returnUrl' => $baseUrl . '/pix.php', // URL de retorno
```

**Nota:** O sistema detecta automaticamente a URL base do site, mas você pode ajustar manualmente se necessário.

## Como Funciona

1. **checkout.php** → Quando o usuário clica em "PAGAR", redireciona para `pix.php`
2. **pix.php** → Carrega e chama `api/create_pix.php` via JavaScript
3. **api/create_pix.php** → Cria a transação PIX na API TitansHub e retorna o QR Code
4. **pix.php** → Exibe o QR Code e inicia verificação de status
5. **api/check_pix_status.php** → Verifica periodicamente se o pagamento foi confirmado

## Webhook (Opcional)

Para receber notificações automáticas quando o pagamento for confirmado, você pode criar o arquivo `api/pix_webhook.php` para processar os postbacks da TitansHub.

## Testes

Após configurar as credenciais, teste o fluxo completo:
1. Adicione produtos ao carrinho
2. Preencha os dados no checkout
3. Clique em "PAGAR"
4. Verifique se o QR Code é gerado corretamente

## Suporte

Em caso de problemas, verifique:
- Se as credenciais estão corretas
- Se a extensão `curl` do PHP está habilitada
- Os logs de erro do PHP
- O console do navegador (F12) para erros JavaScript

