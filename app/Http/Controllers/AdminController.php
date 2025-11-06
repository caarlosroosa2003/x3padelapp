<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reserva;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard de administración
     */
    public function index()
    {
        // Estadísticas generales
        $stats = [
            'total_usuarios' => User::count(),
            'usuarios_nuevos_mes' => User::whereMonth('created_at', now()->month)->count(),
            'total_admins' => User::where('is_admin', true)->count(),
            'usuarios_recientes' => User::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Mostrar la lista de usuarios
     */
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Actualizar un usuario
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'is_admin' => 'boolean',
            'reservas_gratis_disponibles' => 'integer|min:0',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'is_admin' => $request->has('is_admin'),
            'reservas_gratis_disponibles' => $request->reservas_gratis_disponibles ?? $user->reservas_gratis_disponibles,
        ]);

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario
     */
    public function deleteUser(User $user)
    {
        // Prevenir que el admin se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Cambiar estado de administrador de un usuario
     */
    public function toggleAdmin(User $user)
    {
        // Prevenir que el admin se quite sus propios permisos
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'No puedes cambiar tus propios permisos de administrador.');
        }

        $user->update([
            'is_admin' => !$user->is_admin
        ]);

        $status = $user->is_admin ? 'concedidos' : 'revocados';
        return redirect()->route('admin.users')->with('success', "Permisos de administrador {$status} correctamente.");
    }

    /**
     * Buscar usuarios
     */
    public function searchUsers(Request $request)
    {
        $query = $request->get('q');
        
        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('telefono', 'like', "%{$query}%")
            ->paginate(15);

        return view('admin.users', compact('users', 'query'));
    }

    /**
     * Listado de reservas (panel admin)
     */
    public function reservations()
    {
        $perPage = (int) request('per_page', 20);
        if ($perPage < 10) { $perPage = 10; }
        if ($perPage > 100) { $perPage = 100; }

        $reservas = Reserva::with(['user:id,name,email', 'pista:id,nombre'])
            ->latest('fecha')
            ->latest('hora_inicio')
            ->paginate($perPage)
            ->withQueryString();

        // Estadísticas rápidas
        $hoy = now()->toDateString();
        $stats = [
            'total' => Reserva::count(),
            'confirmadas' => Reserva::where('estado', 'confirmada')->count(),
            'pendientes' => Reserva::where('estado', 'pendiente')->count(),
            'canceladas' => Reserva::where('estado', 'cancelada')->count(),
            'hoy' => Reserva::where('fecha', $hoy)->count(),
            'futuras' => Reserva::where('fecha', '>=', $hoy)->count(),
            'ingresos_mes' => (float) Reserva::where('estado', 'confirmada')
                ->whereMonth('fecha', now()->month)
                ->sum('precio'),
            'ingresos_total' => (float) Reserva::where('estado', 'confirmada')->sum('precio'),
            'gratis_mes' => Reserva::where('es_gratis', true)->whereMonth('fecha', now()->month)->count(),
        ];

        return view('admin.reservas.index', compact('reservas', 'stats'));
    }
}
