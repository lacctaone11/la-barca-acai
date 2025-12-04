<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | Tropical Açaí</title>
    <meta name="description" content="Entre em contato com o Tropical Açaí Delivery">
    <link rel="shortcut icon" href="public/images/favicon_acai.webp" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/global.css" rel="stylesheet">
    <style>
        .contact-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            min-height: 100vh;
        }
        .contact-header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 2px solid var(--primaria);
            margin-bottom: 30px;
        }
        .contact-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .contact-header h1 {
            color: var(--primaria);
            font-size: 24px;
            margin: 0;
        }
        .contact-cards {
            display: grid;
            gap: 20px;
            margin-top: 30px;
        }
        .contact-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            border: 1px solid #e9ecef;
        }
        .contact-card i {
            font-size: 40px;
            color: var(--primaria);
            margin-bottom: 15px;
        }
        .contact-card h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        .contact-card p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }
        .contact-card a {
            color: var(--primaria);
            text-decoration: none;
            font-weight: 600;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--primaria);
            text-decoration: none;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .whatsapp-btn {
            display: inline-block;
            background: #25D366;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 15px;
            transition: all 0.3s;
        }
        .whatsapp-btn:hover {
            background: #128C7E;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="delivery">
    <div class="contact-container">
        <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Voltar</a>

        <div class="contact-header">
            <img src="public/images/logo_acai.webp" alt="Tropical Açaí">
            <h1>Fale Conosco</h1>
        </div>

        <div class="contact-cards">
            <div class="contact-card">
                <i class="fa-brands fa-whatsapp"></i>
                <h3>WhatsApp</h3>
                <p>Atendimento rápido pelo WhatsApp</p>
                <a href="https://wa.me/5511999999999" target="_blank" class="whatsapp-btn">
                    <i class="fa-brands fa-whatsapp"></i> Chamar no WhatsApp
                </a>
            </div>

            <div class="contact-card">
                <i class="fa-regular fa-envelope"></i>
                <h3>E-mail</h3>
                <p>Para dúvidas, sugestões ou reclamações</p>
                <p><a href="mailto:contato@tropicalacai.com.br">contato@tropicalacai.com.br</a></p>
            </div>

            <div class="contact-card">
                <i class="fa-regular fa-clock"></i>
                <h3>Horário de Funcionamento</h3>
                <p>Segunda a Domingo</p>
                <p><strong>10:00 às 22:00</strong></p>
            </div>

            <div class="contact-card">
                <i class="fa-solid fa-location-dot"></i>
                <h3>Localização</h3>
                <p>Atendemos em diversas regiões</p>
                <p>Consulte disponibilidade no checkout</p>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
