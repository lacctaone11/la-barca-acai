<?php
// Carrega config se ainda não foi carregada
if (!isset($empresa)) {
    include_once __DIR__ . '/config_empresa.php';
}
?>
<!-- Footer -->
<footer style="background: linear-gradient(135deg, #5b2e91 0%, #3d1f5c 100%); color: #fff; padding: 30px 15px 20px; margin-top: 40px; border-top: 4px solid #7c3aed;">
    <div style="max-width: 500px; margin: 0 auto; text-align: center;">

        <!-- Logo -->
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 20px;">
            <img src="public/images/logo_acai.webp" alt="<?php echo $empresa['nome_fantasia']; ?>" style="width: 50px; height: 50px; border-radius: 50%; border: 3px solid rgba(255,255,255,0.3);">
            <span style="font-size: 20px; font-weight: 700; color: #fff;"><?php echo $empresa['nome_fantasia']; ?></span>
        </div>

        <!-- Links -->
        <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 8px 20px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.2);">
            <a href="index.php" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px;">Início</a>
            <a href="politica-privacidade.php" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px;">Política de Privacidade</a>
            <a href="termos-uso.php" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px;">Termos de Uso</a>
            <a href="contato.php" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px;">Contato</a>
        </div>

        <!-- Dados da Empresa -->
        <div style="background: rgba(0,0,0,0.2); border-radius: 10px; padding: 15px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <p style="color: #fff; font-size: 14px; font-weight: 700; margin: 0 0 8px 0;"><?php echo $empresa['nome_empresa']; ?></p>
            <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin: 4px 0;">CNPJ: <?php echo $empresa['cnpj']; ?></p>
            <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin: 4px 0;"><?php echo $empresa['endereco']; ?></p>
            <p style="color: rgba(255,255,255,0.7); font-size: 12px; margin: 4px 0;"><?php echo $empresa['bairro']; ?> - <?php echo $empresa['cidade']; ?>/<?php echo $empresa['estado']; ?> | CEP: <?php echo $empresa['cep']; ?></p>
        </div>

        <!-- Contato -->
        <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 15px 30px; margin-bottom: 20px;">
            <a href="https://wa.me/<?php echo $empresa['telefone_link']; ?>" target="_blank" style="color: #4ade80; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                <i class="fa-brands fa-whatsapp" style="font-size: 18px;"></i> <?php echo $empresa['telefone']; ?>
            </a>
            <a href="mailto:<?php echo $empresa['email']; ?>" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                <i class="fa-regular fa-envelope" style="font-size: 16px;"></i> <?php echo $empresa['email']; ?>
            </a>
        </div>

        <!-- Selos de Segurança -->
        <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 10px 20px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.2); margin-bottom: 15px;">
            <span style="color: rgba(255,255,255,0.6); font-size: 11px; display: flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-lock" style="color: #4ade80;"></i> Site Seguro
            </span>
            <span style="color: rgba(255,255,255,0.6); font-size: 11px; display: flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-shield-halved" style="color: #4ade80;"></i> Dados Protegidos
            </span>
            <span style="color: rgba(255,255,255,0.6); font-size: 11px; display: flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-credit-card" style="color: #4ade80;"></i> Pagamento Seguro
            </span>
        </div>

        <!-- Copyright -->
        <p style="color: rgba(255,255,255,0.5); font-size: 11px; margin: 0;">© <?php echo date('Y'); ?> <?php echo $empresa['nome_fantasia']; ?>. Todos os direitos reservados.</p>
    </div>
</footer>
