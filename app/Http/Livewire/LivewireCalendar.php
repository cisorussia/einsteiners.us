<?php

//namespace Asantibanez\LivewireCalendar;
namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

/**
 * Class LivewireCalendar
 * @package Asantibanez\LivewireCalendar
 * @property Carbon $startsAt
 * @property Carbon $endsAt
 * @property Carbon $gridStartsAt
 * @property Carbon $gridEndsAt
 * @property int $weekStartsAt
 * @property int $weekEndsAt
 * @property string $calendarView
 * @property string $dayView
 * @property string $eventView
 * @property string $dayOfWeekView
 * @property string $beforeCalendarWeekView
 * @property string $afterCalendarWeekView
 * @property string $dragAndDropClasses
 * @property int $pollMillis
 * @property string $pollAction
 * @property boolean $dragAndDropEnabled
 * @property boolean $dayClickEnabled
 * @property boolean $eventClickEnabled
 */
class LivewireCalendar extends Component
{
    use WithFileUploads;
    
    public $name, $date_event, $description, $location, $cover_path, $cover_add;
    
    public $adminView = false;
    public $selected_id = null;
    public $confirmEvent = false;
    public $updateMode = false;
    public $createMode = false;
    public $previewMode = false;
    public $previewAddMode = false;
    public $upgradeUpload = false;
    
    public $startsAt;
    public $endsAt;

    public $gridStartsAt;
    public $gridEndsAt;

    public $weekStartsAt;
    public $weekEndsAt;

    public $calendarView;
    public $dayView;
    public $eventView;
    public $dayOfWeekView;

    public $dragAndDropClasses;

    public $beforeCalendarView;
    public $afterCalendarView;

    public $pollMillis;
    public $pollAction;

    public $dragAndDropEnabled;
    public $dayClickEnabled;
    public $eventClickEnabled;

    protected $casts = [
        'startsAt' => 'date',
        'endsAt' => 'date',
        'gridStartsAt' => 'date',
        'gridEndsAt' => 'date',
    ];


    // Modal Sand Form

        public $event_name;
        public $personal;
        public $phone;
        public $closeModal = false;

        protected $rules = [
            'event_name' => 'required',
            'personal' => 'required|min:2',
            'phone' => 'required|min:5',
        ];

        private function resetModal()
        {
            $this->personal = null;
            $this->phone = null;
        }

        public function sand($id)
        {
            session()->flash('message', 'Заявка не отправленна, поопробуйте еще раз');
            
            $this->validate();

            Calendar::create([
                'event_name' => $this->enent_name,
                'personal' => $this->personal,
                'phone' => $this->phone,
            ]);

            $this->closeModal = $id;
            $this->resetModal();
            session()->flash('message', 'Заявка отправлена');      
            
        }
    
    // Modal Sand Form

    public function mount($initialYear = null,
                          $initialMonth = null,
                          $weekStartsAt = null,
                          $calendarView = null,
                          $dayView = null,
                          $eventView = null,
                          $dayOfWeekView = null,
                          $dragAndDropClasses = null,
                          $beforeCalendarView = null,
                          $afterCalendarView = null,
                          $pollMillis = null,
                          $pollAction = null,
                          $dragAndDropEnabled = true,
                          $dayClickEnabled = true,
                          $eventClickEnabled = true,
                          $extras = [])
    {
        $this->weekStartsAt = $weekStartsAt ?? Carbon::SUNDAY;
        $this->weekEndsAt = $this->weekStartsAt == Carbon::SUNDAY
            ? Carbon::SATURDAY
            : collect([0,1,2,3,4,5,6])->get($this->weekStartsAt + 6 - 7)
        ;

        $initialYear = $initialYear ?? Carbon::today()->year;
        $initialMonth = $initialMonth ?? Carbon::today()->month;

        $this->startsAt = Carbon::createFromDate($initialYear, $initialMonth, 1)->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->calculateGridStartsEnds();

        $this->setupViews($calendarView, $dayView, $eventView, $dayOfWeekView, $beforeCalendarView, $afterCalendarView);

        $this->setupPoll($pollMillis, $pollAction);

        $this->dragAndDropEnabled = $dragAndDropEnabled;
        $this->dragAndDropClasses = $dragAndDropClasses ?? 'border border-blue-400 border-4';

        $this->dayClickEnabled = $dayClickEnabled;
        $this->eventClickEnabled = $eventClickEnabled;

        $this->afterMount($extras);
    }

    public function afterMount($extras = [])
    {
        //
    }

    public function setupViews($calendarView = null,
                               $dayView = null,
                               $eventView = null,
                               $dayOfWeekView = null,
                               $beforeCalendarView = null,
                               $afterCalendarView = null)
    {
        $this->calendarView = $calendarView ?? 'livewire-calendar::calendar';
        $this->dayView = $dayView ?? 'livewire-calendar::day';
        $this->eventView = $eventView ?? 'livewire-calendar::event';
        $this->dayOfWeekView = $dayOfWeekView ?? 'livewire-calendar::day-of-week';

        $this->beforeCalendarView = $beforeCalendarView ?? null;
        $this->afterCalendarView = $afterCalendarView ?? null;
    }

    public function setupPoll($pollMillis, $pollAction)
    {
        $this->pollMillis = $pollMillis;
        $this->pollAction = $pollAction;
    }

    public function goToPreviousMonth()
    {
        $this->startsAt->subMonthNoOverflow();
        $this->endsAt->subMonthNoOverflow();

        $this->calculateGridStartsEnds();
    }

    public function goToNextMonth()
    {
        $this->startsAt->addMonthNoOverflow();
        $this->endsAt->addMonthNoOverflow();

        $this->calculateGridStartsEnds();
    }

    public function goToCurrentMonth()
    {
        $this->startsAt = Carbon::today()->startOfMonth()->startOfDay();
        $this->endsAt = $this->startsAt->clone()->endOfMonth()->startOfDay();

        $this->calculateGridStartsEnds();
    }

    public function calculateGridStartsEnds()
    {
        $this->gridStartsAt = $this->startsAt->clone()->startOfWeek($this->weekStartsAt);
        $this->gridEndsAt = $this->endsAt->clone()->endOfWeek($this->weekEndsAt);
    }

    /**
     * @throws Exception
     */
    public function monthGrid()
    {
        $firstDayOfGrid = $this->gridStartsAt;
        $lastDayOfGrid = $this->gridEndsAt;

        $numbersOfWeeks = $lastDayOfGrid->diffInWeeks($firstDayOfGrid) + 1;
        $days = $lastDayOfGrid->diffInDays($firstDayOfGrid) + 1;

        if ($days % 7 != 0) {
            throw new Exception("Livewire Calendar not correctly configured. Check initial inputs.");
        }

        $monthGrid = collect();
        $currentDay = $firstDayOfGrid->clone();

        while(!$currentDay->greaterThan($lastDayOfGrid)) {
            $monthGrid->push($currentDay->clone());
            $currentDay->addDay();
        }

        $monthGrid = $monthGrid->chunk(7);
        if ($numbersOfWeeks != $monthGrid->count()) {
            throw new Exception("Livewire Calendar calculated wrong number of weeks. Sorry :(");
        }

        return $monthGrid;
    }

    public function events() : Collection
    {
        return collect();
    }

    public function getEventsForDay($day, Collection $events) : Collection
    {
        return $events
            ->filter(function ($event) use ($day) {
                return Carbon::parse($event['date_event'])->isSameDay($day);
            });
    }

    public function onDayClick($year, $month, $day)
    {
        //
    }

    public function onEventClick($eventId)
    {
        //
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        //
    }

    private function resetInput()
    {
        $this->name = null;
        $this->cover_path = null;
    }

    public function create()
    {
        $this->selected_id = null;
        $this->updateMode = false;
        $this->createMode = true;
        $this->resetInput();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:5',
            'cover_add' => 'required|image|max:1024',
            'date_event' => 'required|after:1945-01-01',
            'location' => 'required|min:5',
            'description' => 'required|min:50',
        ]);

        Calendar::create([
            'name' => $this->name,
            'cover_add' => $this->cover_add,
            'date_event' => $this->date_event,
            'location' => $this->location,
            'cover_path' => $this->cover_add->store('upload/calendar', 'public'),
            'description' => $this->description,
        ]);
        $this->resetInput();
        $this->createMode = false;
        $this->previewAddMode = false;

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие добавлено');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event added');
        }
        
    }

    public function updatedCoverAdd()
    {
        $this->validate([
            'cover_add' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->updateMode = false;
        $this->previewAddMode = $this->cover_add->store('upload/calendar', 'public');
    }

    public function updatedCoverPath()
    {
        $this->validate([
            'cover_path' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->previewMode = $this->cover_path->store('upload/calendar', 'public');
        $this->upgradeUpload = true;
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->confirmEvent = false;
        $event = Calendar::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $event->name;
        $this->cover_path = $event->cover_path;
        $this->date_event = $event->date_event;
        $this->location = $event->location;
        $this->description = $event->description;
        $this->resetValidation();
    }

    public function update()
    {    
        if ($this->upgradeUpload) {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:5',
                'cover_path' => 'required|image|max:1024',
                'date_event' => 'required|after:1945-01-01',
                'location' => 'required|min:5',
                'description' => 'required|min:50',
            ]);
            if ($this->selected_id) {
                $event = Calendar::find($this->selected_id);
                $event->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'date_event' => $this->date_event,
                    'location' => $this->location,
                    'cover_path' => $this->cover_path->store('upload/calendar', 'public'),
                    'description' => $this->description,
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;

                if (App::isLocale('ru')) {
                    session()->flash('message', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message', 'Changes saved');
                }
            }
        } else {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:5',
                'location' => 'required|min:5',
                'date_event' => 'required|after:1945-01-01',
                'description' => 'required|min:50',
                //'cover_path' => 'required|image|max:1024',
            ]);
            if ($this->selected_id) {
                $event = Calendar::find($this->selected_id);
                $event->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'date_event' => $this->date_event,
                    'location' => $this->location,
                    'description' => $this->description,
                    //'cover_path' => $this->cover_path->store('upload', 'public'),
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;

                if (App::isLocale('ru')) {
                    session()->flash('message', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message', 'Changes saved');
                }
            }
        }
        
    }

    public function deleteConfirm($id)
    {
        $this->updateMode = false;
        $this->confirmEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
    }

    public function delete($id)
    {
        if ($id) {
            $event = Calendar::where('id', $id);  
            $image = DB::table('calendars')->where('id', $id)->first();
            $this->confirmEvent = false;
            sleep(1);
            Storage::disk('public')->delete($image->cover_path);
            $event->delete();
        }

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие удалено');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event deleted');
        }
    }

    /**
     * @return Factory|View
     * @throws Exception
     */
    public function render()
    {
        $events = $this->events();

        if (Auth::user()) {
            $user = Auth::user();
            if ($user->role_id == '3') {
                $this->adminView = true;
                return view($this->calendarView)
                ->with([
                    'componentId' => $this->id,
                    'monthGrid' => $this->monthGrid(),
                    'events' => $events,
                    'getEventsForDay' => function ($day) use ($events) {
                        return $this->getEventsForDay($day, $events);
                    }
                ]);
            } else {
                return view($this->calendarView)
                ->with([
                    'componentId' => $this->id,
                    'monthGrid' => $this->monthGrid(),
                    'events' => $events,
                    'getEventsForDay' => function ($day) use ($events) {
                        return $this->getEventsForDay($day, $events);
                    }
                ]);
            }
        } else {
            return view($this->calendarView)
            ->with([
                'componentId' => $this->id,
                'monthGrid' => $this->monthGrid(),
                'events' => $events,
                'getEventsForDay' => function ($day) use ($events) {
                    return $this->getEventsForDay($day, $events);
                }
            ]);
        }

    }
}
