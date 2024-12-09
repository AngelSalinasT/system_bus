<?php
namespace App\Livewire;

use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Route;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduleComponent extends Component
{
    use WithPagination;

    public $date, $departure_time, $arrival_time, $route_id, $bus_id;
    public $isEditMode = false, $schedule_id;

    public $routes, $buses;

    // Cargar buses y rutas al iniciar el componente
    public function mount()
    {
        $this->routes = Route::all();
        $this->buses = Bus::all();
    }

    // Validar los datos
    protected $rules = [
        'date' => 'required|date',
        'departure_time' => 'required|date_format:H:i',
        'arrival_time' => 'nullable|date_format:H:i',
        'route_id' => 'required|exists:routes,id',
        'bus_id' => 'required|exists:buses,id',
    ];

    // Crear un nuevo horario
    public function createSchedule()
    {
        $this->validate();

        Schedule::create([
            'date' => $this->date,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'route_id' => $this->route_id,
            'bus_id' => $this->bus_id,
        ]);

        session()->flash('message', 'Schedule created successfully.');

        // Resetear campos
        $this->resetFields();
    }

    // Editar un horario existente
    public function editSchedule($schedule_id)
    {
        $this->isEditMode = true;

        $schedule = Schedule::find($schedule_id);

        $this->schedule_id = $schedule->id;
        $this->date = $schedule->date;
        $this->departure_time = $schedule->departure_time;
        $this->arrival_time = $schedule->arrival_time;
        $this->route_id = $schedule->route_id;
        $this->bus_id = $schedule->bus_id;
    }

    // Actualizar el horario
    public function updateSchedule()
    {
        $this->validate();

        $schedule = Schedule::find($this->schedule_id);
        $schedule->update([
            'date' => $this->date,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'route_id' => $this->route_id,
            'bus_id' => $this->bus_id,
        ]);

        session()->flash('message', 'Schedule updated successfully.');

        $this->resetFields();
    }

    // Eliminar un horario
    public function deleteSchedule($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);
        $schedule->delete();

        session()->flash('message', 'Schedule deleted successfully.');
    }

    // Resetear los campos del formulario
    public function resetFields()
    {
        $this->date = '';
        $this->departure_time = '';
        $this->arrival_time = '';
        $this->route_id = '';
        $this->bus_id = '';
        $this->isEditMode = false;
    }

    public function render()
    {
        $schedules = Schedule::paginate(10);

        return view('livewire.schedule-component', compact('schedules'));
    }
}
