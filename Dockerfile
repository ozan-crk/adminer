FROM adminer:latest

USER root

# Plugin dosyalarını ve loader'ı kopyala
# Resmi adminer imajında pluginler /var/www/html/plugins altında toplanır
COPY adminer-plugins/ /var/www/html/plugins/
COPY adminer-plugins.php /var/www/html/adminer-plugins.php

# Gerekirse izinleri ayarla
RUN chown -R adminer:adminer /var/www/html/plugins /var/www/html/adminer-plugins.php

USER adminer
