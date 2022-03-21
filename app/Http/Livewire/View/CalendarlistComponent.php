<?php

namespace App\Http\Livewire\View;

use Illuminate\Support\Facades\App;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Activitie;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Models\User;
use App\Models\Children;

class CalendarlistComponent extends Component
{
    use Notifiable;
    use WithPagination;
    use WithFileUploads;

    public $childrenlist, $user, $select_calendars, $calendars, $name, $age, $date_event, $date_time, $description, $location, $cover_path, $cover_add;

    public $personal, $phone, $date, $children, $liability, $screening, $waiver, $release;

    public $now;

    public $adminView = false;
    public $selected_id = null;
    public $confirmEvent = false;
    public $updateMode = false;
    public $createMode = false;
    public $previewMode = false;
    public $previewAddMode = false;
    public $upgradeUpload = false;
    public $closeModal = false;
    public $callbackModal = false;

    public $format = 'd.m.Y';
    public $format_calendar = '0';

    public function render()
    {
        $user = Auth::user();
        $this->now = date_format(new DateTime('now'),"d-m-Y");

        if (isset($user)) {
            if($user['role_id'] == '3') {
                $this->adminView = true;
            } else {
                $this->adminView = false;
            }
        } else {
            $this->adminView = false; 
        }

        if(isset($user)) {
            $this->user = $user->id;
            $this->childrenlist = Children::where('user_id', $user->id)->get();
        }

        $this->calendars = Calendar::all()->sortBy('date_event');
        return view('livewire.calendar.list');
    }

    public function store()
    {
        $date_after = Carbon::today()->format('Y-m-d');
        $date_before = Carbon::today()->addDays(60)->format('Y-m-d');
        
        $this->date_event = Carbon::createFromFormat($this->format, $this->date_event)->timestamp;
        
        $user = Auth::user();
        $this->validate([
            'name' => 'required|min:1',
            'cover_add' => 'required|image|max:1024',
            'age' => 'required|min:1',
            'location' => 'required|min:1',
            'date_event' => 'required|after:1945-01-01',
            'description' => 'required|min:1',
        ]);

        Calendar::create([
            'name' => $this->name,
            'cover_path' => $this->cover_add->store('upload/calendar', 'public'),
            'date_event' => $this->date_event,
            'date_time' => $this->date_time,
            'age' => $this->age,
            'location' => $this->location,
            'description' => $this->description,
        ]);
        $this->resetInput();
        $this->createMode = false;
        $this->previewAddMode = false;
        $this->closeModal = 'crevent';

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие добавлено');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event added');
        }
        
    }

    public function callbackModal($id) {
        $this->select_calendars = Calendar::find($id);
        $this->callbackModal = true;
    }

    public function routeNotificationForMail($notification)
    {
        return 'info@einsteiners.us';
    }

    public function sand($id) {
        $this->select_calendars = Calendar::find($id);
        $this->callbackModal = false;

        $this->validate([
            'personal' => 'required|min:1',
            'phone' => 'required|min:1',
            'children' => 'required|min:1',
        ]);

        $params = [
            'orderTitle' => $this->select_calendars->name,
            'orderTime' => $this->select_calendars->date_event,
            'orderName' => $this->personal,
            'orderPhone' => $this->phone,
            'orderChildren' => $this->children,
            'orderLiability' => true,
            'orderScreening' => true,
            'orderWaiver' => true,
            'orderRelease' => true,
        ];
        Mail::to('info@einsteiners.us')->send(new Feedback($params));

        $this->resetInput();
        if (App::isLocale('ru')) {
            session()->flash('message', 'Заявка отправлена');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'The application has been sent');
        }
    }

    public function update()
    {    
        $date_after = Carbon::today()->format('Y-m-d');
        $date_before = Carbon::today()->addDays(60)->format('Y-m-d');

        $this->date_event = Carbon::createFromFormat($this->format, $this->date_event)->timestamp;
        
        if ($this->upgradeUpload) {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:1',
                'cover_path' => 'required|image|max:1024',
                'age' => 'required|min:1',
                'location' => 'required|min:5',
                'date_event' => 'required|after:1945-01-01',
                'description' => 'required|min:1',
            ]);
            if ($this->selected_id) {
                $calendars = Calendar::find($this->selected_id);
                $calendars->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'cover_path' => $this->cover_path->store('upload/event', 'public'),
                    'date_event' => $this->date_event,
                    'date_time' => $this->date_time,
                    'age' => $this->age,
                    'location' => $this->location,
                    'description' => $this->description,
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;
                $this->closeModal = 'editevent';

                if (App::isLocale('ru')) {
                    session()->flash('message', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message', 'Changes saved');
                }
            }
        } else {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:1',
                //'cover_path' => 'required|image|max:1024',
                'age' => 'required|min:1',
                'location' => 'required|min:5',
                'date_event' => 'required|after:1945-01-01',
                'description' => 'required|min:1',
            ]);
            if ($this->selected_id) {
                $calendars = Calendar::find($this->selected_id);
                $calendars->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'date_event' => $this->date_event,
                    'date_time' => $this->date_time,
                    'age' => $this->age,
                    'location' => $this->location,
                    'description' => $this->description,
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;
                $this->closeModal = 'editevent';

                if (App::isLocale('ru')) {
                    session()->flash('message', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message', 'Changes saved');
                }
            }
        }
        
    }

    public function delete($id)
    {
        if ($id) {
            $calendars = Calendar::where('id', $id);  
            $image = DB::table('calendars')->where('id', $id)->first();
            $this->confirmEvent = false;
            sleep(1);
            $calendars->delete();
        }

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие удаленно');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event deleted');
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->cover_path = null;
        $this->age = null;
        $this->location = null;
        $this->date_event = null;
        $this->date_time = null;
        $this->description = null;
        $this->selected_id = null;
        $this->format = 'd.m.Y';
    }

    public function create()
    {
        $this->selected_id = null;
        $this->updateMode = false;
        $this->createMode = true;
        $this->resetInput();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->confirmEvent = false;
        $calendars = Calendar::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $calendars->name;
        $this->cover_path = $calendars->cover_path;
        $this->age = $calendars->age;
        $this->location = $calendars->location;
        $this->date_event = $calendars->date_event;
        $this->date_time = $calendars->date_time;
        $this->description = $calendars->description;
        $this->resetValidation();
    }

    public function deleteConfirm($id)
    {
        $this->updateMode = false;
        $this->confirmEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
    }

    public function deactiveConfirm($id)
    {
        $this->updateMode = false;
        $this->deactiveEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
    }

    public function activeConfirm($id)
    {
        $this->updateMode = false;
        $this->activeEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
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

}
