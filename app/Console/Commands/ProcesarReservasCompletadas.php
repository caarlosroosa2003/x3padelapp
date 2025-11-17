<?php

namespace App\Console\Commands;

use App\Http\Controllers\ReservaController;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcesarReservasCompletadas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservas:procesar-completadas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procesa las reservas que ya pasaron, marca no-shows, otorga recompensas y actualiza contadores';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Procesando reservas completadas...');

        // Obtener todas las reservas que ya pasaron y están confirmadas (no canceladas)
        $reservasCompletadas = Reserva::where('estado', 'confirmada')
            ->whereRaw('CONCAT(fecha, " ", hora_fin) < ?', [now()])
            ->with('user')
            ->get();

        $procesadas = 0;
        $noShows = 0;
        $recompensasOtorgadas = 0;

        foreach ($reservasCompletadas as $reserva) {
            $user = $reserva->user;

            // Marcar como no-show si no se hizo check-in
            if (!$reserva->check_in_realizado) {
                $reserva->marcarNoShow();
                $noShows++;
            }

            // Actualizar estado a completada
            $reserva->update(['estado' => 'completada']);

            // Recalcular reservas completadas y otorgar recompensas
            $reservasCompletadasAnterior = $user->reservas_completadas;
            $recompensasDisponiblesAnterior = $user->reservas_gratis_disponibles;
            
            $user->recalcularReservasCompletadas();

            // Verificar si se otorgó una nueva recompensa
            if ($user->reservas_gratis_disponibles > $recompensasDisponiblesAnterior) {
                $recompensasOtorgadas++;
            }

            $procesadas++;
        }

        $this->info("Reservas procesadas: {$procesadas}");
        $this->info("No-shows detectados: {$noShows}");
        $this->info("Recompensas otorgadas: {$recompensasOtorgadas}");

        return Command::SUCCESS;
    }
}
