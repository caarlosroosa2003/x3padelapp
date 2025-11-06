@echo off
echo ========================================
echo    X3 PADEL - Comandos Rapidos
echo ========================================
echo.
echo Selecciona una opcion:
echo.
echo 1. Iniciar servidor Laravel
echo 2. Compilar assets (desarrollo)
echo 3. Compilar assets (produccion)
echo 4. Ver rutas
echo 5. Limpiar cache
echo 6. Iniciar TODO (servidor + assets dev)
echo 7. Migrar BD y seed de ejemplo
echo 8. Ejecutar tests (Feature)
echo 9. Salir
echo.
set /p opcion="Ingresa el numero de opcion: "

if "%opcion%"=="1" goto servidor
if "%opcion%"=="2" goto dev
if "%opcion%"=="3" goto build
if "%opcion%"=="4" goto rutas
if "%opcion%"=="5" goto cache
if "%opcion%"=="6" goto todo
if "%opcion%"=="7" goto seed
if "%opcion%"=="8" goto tests
if "%opcion%"=="9" goto salir

:servidor
echo.
echo Iniciando servidor Laravel...
php artisan serve
goto fin

:dev
echo.
echo Compilando assets en modo desarrollo...
npm run dev
goto fin

:build
echo.
echo Compilando assets para produccion...
npm run build
goto fin

:rutas
echo.
echo Lista de rutas:
php artisan route:list
pause
goto fin

:seed
echo.
echo Migrando base de datos y sembrando datos de ejemplo...
php artisan migrate:fresh --seed
pause
goto fin

:tests
echo.
echo Ejecutando tests de Feature...
php artisan test --testsuite=Feature
pause
goto fin

:cache
echo.
echo Limpiando cache...
php artisan cache:clear
php artisan config:clear
php artisan view:clear
echo Cache limpiado!
pause
goto fin

:todo
echo.
echo Iniciando servidor Laravel y compilador de assets...
echo.
echo IMPORTANTE: Esto abrira 2 ventanas nuevas
echo - Una para el servidor Laravel (php artisan serve)
echo - Otra para compilar assets (npm run dev)
echo.
pause

start cmd /k "title Laravel Server && php artisan serve"
start cmd /k "title Vite Dev Server && npm run dev"

echo.
echo Servidores iniciados!
echo.
echo Laravel: http://localhost:8000
echo.
echo Presiona cualquier tecla para cerrar esta ventana...
pause > nul
goto salir

:salir
exit

:fin
echo.
echo Presiona cualquier tecla para volver al menu...
pause > nul
cls
goto :eof


