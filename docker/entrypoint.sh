#!/bin/sh
set -e

# Pastikan folder upload tersedia dan writable oleh www-data
mkdir -p \
    /var/www/html/public/uploads/album \
    /var/www/html/public/uploads/blog \
    /var/www/html/public/uploads/dosen \
    /var/www/html/public/uploads/mahasiswa \
    /var/www/html/public/uploads/scope \
    /var/www/html/public/assets/images/tentang

chown -R www-data:www-data /var/www/html/public
chmod -R 775 /var/www/html/public

exec "$@"
