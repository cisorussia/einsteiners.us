<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\App;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Event;
use App\Models\User;
//use App\Models\Guest;
//use App\Models\Gift;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventComponent extends Component
{
    
    use WithFileUploads;
    use WithPagination;
    public /*$events,*/ $user, $users, $active, $link, $cover_path, $user_id, $name, $description, $date_event, $date_time, $location, $tags, $reviewed;
    public $cover_add;
    public $selected_id = null;
    public $updateMode = false;
    public $createMode = false;
    public $previewMode = false;
    public $previewAddMode = false;
    public $confirmEvent = false;
    public $deactiveEvent = false;
    public $activeEvent = false;
    public $upgradeUpload = false;
    public $adminView = false;

    public $format = 'd.m.Y';
    public $format_calendar = '0';
    
    public function paginationView()
    {
        return 'vendor.livewire.uikit';
    }

    public function render()
    {
        $user = Auth::user();
        $this->user = $user->id;
        if ($user->role_id == '3') {
            $this->adminView = true;
            $this->users = User::all();
            //$this->events = Event::all();
            return view('livewire.event.event', [
                'events' => Event::orderBy('id', 'desc')->paginate(10),
            ]);
        } else {
            return view('livewire.event.event', [
                'events' => Event::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10),
            ]);
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->cover_path = null;
        $this->location = null;
        $this->date_event = null;
        $this->date_time = null;
        $this->description = null;
        $this->tags = null;
        $this->format = 'd.m.Y';
    }

    public function store()
    {
        $date_after = Carbon::today()->format('Y-m-d');
        $date_before = Carbon::today()->addDays(60)->format('Y-m-d');
        
        $this->date_event = Carbon::createFromFormat($this->format, $this->date_event)->timestamp;
        
        $user = Auth::user();
        $this->validate([
            'name' => 'required|min:2',
            'cover_add' => 'required|image|max:1024',
            'location' => 'required|min:5',
            'date_event' => 'required|after:' . $date_after . '|before:' . $date_before,
            'description' => 'required|min:5',
            'tags' => 'required|min:5',
        ]);

        Event::create([
            'name' => $this->name,
            'cover_path' => $this->cover_add->store('upload/event', 'public'),
            'date_event' => $this->date_event,
            'date_time' => $this->date_time,
            'location' => $this->location,
            'description' => $this->description,
            'link' => md5($user->id) . md5(date("d.m.Y")),
            'tags' => $this->tags,
            'user_id' => $user->id,
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

    public function create()
    {
        $this->selected_id = null;
        $this->updateMode = false;
        $this->createMode = true;
        $this->resetInput();
    }

    public function updatedCoverAdd()
    {
        $this->validate([
            'cover_add' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->updateMode = false;
        $this->previewAddMode = $this->cover_add->store('upload/event', 'public');
    }

    public function updatedCoverPath()
    {
        $this->validate([
            'cover_path' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->previewMode = $this->cover_path->store('upload/event', 'public');
        $this->upgradeUpload = true;
    }

    public function update()
    {    
        $date_after = Carbon::today()->format('Y-m-d');
        $date_before = Carbon::today()->addDays(60)->format('Y-m-d');

        $this->date_event = Carbon::createFromFormat($this->format, $this->date_event)->timestamp;

        if ($this->upgradeUpload) {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:2',
                'cover_path' => 'required|image|max:1024',
                'location' => 'required|min:5',
                'date_event' => 'required|after:' . $date_after . '|before:' . $date_before,
                'description' => 'required|min:5',
                'tags' => 'required|min:5',
            ]);
            if ($this->selected_id) {
                $event = Event::find($this->selected_id);
                $event->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'cover_path' => $this->cover_path->store('upload/event', 'public'),
                    'date_event' => $this->date_event,
                    'date_time' => $this->date_time,
                    'location' => $this->location,
                    'description' => $this->description,
                    'tags' => $this->tags,
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
                'name' => 'required|min:2',
                //'cover_path' => 'required|image|max:1024',
                'location' => 'required|min:5',
                'date_event' => 'required|after:' . $date_after . '|before:' . $date_before,
                'description' => 'required|min:5',
                'tags' => 'required|min:5',
            ]);
            if ($this->selected_id) {
                $event = Event::find($this->selected_id);
                $event->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    //'cover_path' => $this->cover_path->store('upload', 'public'),
                    'date_event' => $this->date_event,
                    'date_time' => $this->date_time,
                    'location' => $this->location,
                    'description' => $this->description,
                    'tags' => $this->tags,
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

    public function edit($id)
    {
        $this->updateMode = true;
        $this->confirmEvent = false;
        $event = Event::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $event->name;
        $this->cover_path = $event->cover_path;
        $this->location = $event->location;
        $this->date_event = $event->date_event;
        $this->date_time = $event->date_time;
        $this->description = $event->description;
        $this->tags = $event->tags;

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

    public function deactive($id)
    {
        if ($id) {
            $event = Event::where('id', $id);  
            $this->confirmEvent = false;
            sleep(1);
            $event->update([
                'active' => '0'
            ]);
        }
        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие снято с публикации');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event remove from publication');
        }
    }

    public function active($id)
    {
        if ($id) {
            $event = Event::where('id', $id);  
            $this->confirmEvent = false;
            sleep(1);
            $event->update([
                'active' => '1'
            ]);
        }
        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие опубликованно');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event publish');
        }
    }

    public function delete($id)
    {
        if ($id) {
            $event = Event::where('id', $id);  
            $image = DB::table('events')->where('id', $id)->first();
            $guests = DB::table('guests')->where('event_id', $id);
            $gifts = DB::table('gifts')->where('event_id', $id);
            $this->confirmEvent = false;
            sleep(1);
            $guests->delete();
            $gifts->delete();
            $event->delete();
        }

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие удаленно');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event deleted');
        }
    }
}
