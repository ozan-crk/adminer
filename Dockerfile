FROM adminer:latest

USER root

# Plugin dosyalarını ve loader'ları kopyala
COPY adminer-plugins/ /var/www/html/plugins/
COPY plugins-enabled/ /var/www/html/plugins-enabled/
COPY adminer-plugins.php /var/www/html/adminer-plugins.php

# Gerekirse izinleri ayarla
RUN chown -R adminer:adminer /var/www/html/plugins /var/www/html/plugins-enabled /var/www/html/adminer-plugins.php

USER adminer
