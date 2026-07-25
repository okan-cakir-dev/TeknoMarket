@echo off
color 0B
title TeknoMarket Sunucusu
echo ===================================================
echo TeknoMarket E-Ticaret Sunucusu Baslatiliyor...
echo Lutfen Laragon'un (MySQL) acik oldugundan emin ol.
echo.
echo Siteye gitmek icin tarayicida: http://127.0.0.1:8000
echo Sunucuyu durdurmak icin bu siyah pencereyi kapat.
echo ===================================================
cd C:\laragon\www\eticaret
php artisan serve
pause