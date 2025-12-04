<?php
// Incluir config se ainda não foi incluído
if (!isset($empresa)) {
    include_once __DIR__ . '/config_empresa.php';
}
?>
<!-- Footer -->
<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-logo">
            <img src="public/images/logo_acai.webp" alt="<?php echo $empresa['nome_fantasia']; ?>" width="50" height="50">
            <span><?php echo $empresa['nome_fantasia']; ?></span>
        </div>

        <div class="footer-links">
            <a href="index.php">Início</a>
            <a href="politica-privacidade.php">Política de Privacidade</a>
            <a href="termos-uso.php">Termos de Uso</a>
            <a href="contato.php">Contato</a>
        </div>

        <div class="footer-address">
            <p><strong><?php echo $empresa['nome_empresa']; ?></strong></p>
            <p>CNPJ: <?php echo $empresa['cnpj']; ?></p>
            <p><?php echo $empresa['endereco']; ?></p>
            <p><?php echo $empresa['bairro']; ?> - <?php echo $empresa['cidade']; ?>/<?php echo $empresa['estado']; ?></p>
            <p>CEP: <?php echo $empresa['cep']; ?></p>
        </div>

        <div class="footer-contact">
            <p><a href="https://wa.me/<?php echo $empresa['telefone_link']; ?>" target="_blank" style="color:#ccc;text-decoration:none;"><i class="fa-brands fa-whatsapp"></i> <?php echo $empresa['telefone']; ?></a></p>
            <p><a href="mailto:<?php echo $empresa['email']; ?>" style="color:#ccc;text-decoration:none;"><i class="fa-regular fa-envelope"></i> <?php echo $empresa['email']; ?></a></p>
        </div>

        <div class="footer-info">
            <p>© <?php echo date('Y'); ?> <?php echo $empresa['nome_fantasia']; ?>. Todos os direitos reservados.</p>
        </div>

        <div class="footer-security">
            <span><i class="fa-solid fa-lock"></i> Site Seguro</span>
            <span><i class="fa-solid fa-shield-halved"></i> Dados Protegidos</span>
            <span><i class="fa-solid fa-credit-card"></i> Pagamento Seguro</span>
        </div>
    </div>
</footer>
