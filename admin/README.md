# Painel Admin - Açaí Mania

## Funcionalidades

1. **Autenticação JWT** - Sistema de login seguro usando JSON Web Tokens
2. **Visualização de Dados de Cartão** - Veja todos os dados de cartão de crédito preenchidos pelos clientes
3. **Gerenciamento de Credenciais PIX** - Altere as credenciais da API PIX diretamente pelo painel

## Acesso

**URL:** `http://localhost/mydelivery/admin/login.php`

**Credenciais Padrão:**
- Usuário: `admin`
- Senha: `admin123`

⚠️ **IMPORTANTE:** Altere essas credenciais em produção!

## Como Alterar Credenciais de Login

Edite o arquivo `admin/login.php` e altere as variáveis:

```php
$validUsername = 'seu_usuario';
$validPassword = 'sua_senha_segura';
```

## Estrutura de Arquivos

```
admin/
├── jwt_helper.php          # Funções JWT
├── login.php              # Página de login
├── dashboard.php          # Painel principal
├── logout.php             # Logout
├── auth_check.php         # Verificação de autenticação
├── api/
│   ├── save_card_data.php      # Salva dados do cartão
│   ├── get_card_data.php        # Obtém dados do cartão
│   ├── get_pix_credentials.php # Obtém credenciais PIX
│   └── save_pix_credentials.php # Salva credenciais PIX
└── data/                  # Dados salvos (criado automaticamente)
    ├── card_data_YYYY-MM-DD.json
    └── pix_config.json
```

## Segurança

- Os dados do cartão são salvos apenas com os últimos 4 dígitos
- Tokens JWT expiram em 24 horas
- Cookies HTTPOnly para maior segurança
- Validação de autenticação em todas as páginas protegidas

## Dados Salvos

Quando um cliente preenche o formulário de cartão de crédito, os seguintes dados são salvos:

- Últimos 4 dígitos do cartão
- Nome do titular
- CPF do titular
- Bandeira do cartão
- Validade
- Valor da transação
- Dados do cliente (nome, email, telefone, endereço)
- IP e User Agent

## Configuração PIX

No painel admin, você pode:

1. Visualizar as credenciais atuais da API PIX
2. Alterar as credenciais (chave pública e secreta)
3. As alterações são aplicadas automaticamente nos arquivos:
   - `api/create_pix.php`
   - `api/check_pix_status.php`

## Permissões

Certifique-se de que a pasta `admin/data/` tenha permissões de escrita:

```bash
chmod 755 admin/data/
```

## Troubleshooting

### Erro ao salvar dados
- Verifique se a pasta `admin/data/` existe e tem permissões de escrita
- Verifique os logs de erro do PHP

### Não consigo fazer login
- Verifique se as credenciais estão corretas
- Limpe os cookies do navegador
- Verifique se o JWT está funcionando corretamente

### Dados não aparecem no painel
- Verifique se há dados salvos em `admin/data/`
- Verifique o console do navegador (F12) para erros JavaScript
- Verifique se os endpoints da API estão acessíveis

