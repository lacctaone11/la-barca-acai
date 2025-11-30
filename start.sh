#!/bin/bash

# Configurar porta do Railway (ou usar 80 como padrão)
PORT=${PORT:-80}

# Atualizar configuração do Apache para usar a porta correta
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Iniciar Apache
apache2-foreground
