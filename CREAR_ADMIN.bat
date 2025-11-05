@echo off
echo ========================================
echo   X3 PADEL - Crear Administrador
echo ========================================
echo.
echo Este script te ayudara a crear un usuario administrador.
echo.
set /p email="Ingresa el email del usuario: "
echo.
echo Procesando...
echo.
php artisan user:make-admin %email%
echo.
echo ========================================
echo.
pause




