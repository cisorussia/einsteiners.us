<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use App\Models\Children;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChildrenComponent extends Component
{
    public $guests, $name, $birthday, $selected_guest;
    public $updateMode = false;
    public $addMode = false;
    public $confirmGuest = false;

    public $format = 'd.m.Y';
    public $format_calendar = '0';

    public function render()
    {
        $user = Auth::user();
        $this->guests = Children::where('user_id', $user->id)->get();
        return view('livewire.profile.children');
    }

    private function resetInput()
    {
        $this->selected_guest = null;
        $this->name = null;
        $this->birthday = null;
        $this->format = 'd.m.Y';
    }

    public function add()
    {
        $this->addMode = true;
        $this->confirmGuest = false;
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->addMode = true;
        $guest = Children::findOrFail($id);
        $this->selected_guest = $id;
        $this->name = $guest->name;
        $this->birthday = $guest->birthday;
        $this->confirmGuest = false;
    }

    public function store()
    {
        $this->birthday = Carbon::createFromFormat($this->format, $this->birthday)->timestamp;

        $user = Auth::user();
        $this->validate([
            'name' => 'required|min:2',
            'birthday' => ['required', 'after:1945-01-01'],
        ]);
        Children::create([
            'name' => $this->name,
            'birthday' => $this->birthday,
            'user_id' => $user->id,
        ]);
        $this->resetInput();
        $this->addMode = false;
        if (App::isLocale('ru')) {
            session()->flash('message-guest', 'Ребенок добавлен');
        } elseif (App::isLocale('en')) {
            session()->flash('message-guest', 'Kid added');
        }
    }

    public function deleteConfirm($id)
    {
        $this->updateMode = false;
        $this->confirmGuest = $id;
    }

    public function update()
    {    
        $this->birthday = Carbon::createFromFormat($this->format, $this->birthday)->timestamp;

        $this->validate([
            'name' => 'required|min:2',
            'birthday' => ['required', 'after:1945-01-01'],
        ]);
        if ($this->selected_guest) {
            $event = Children::find($this->selected_guest);
            $event->update([
                'id' => $this->selected_guest,
                'name' => $this->name,
                'birthday' => $this->birthday,

            ]);
            $this->resetInput();
            $this->addMode = false;
            $this->updateMode = false;
            if (App::isLocale('ru')) {
                session()->flash('message-guest', 'Изменения сохранены');
            } elseif (App::isLocale('en')) {
                session()->flash('message-guest', 'Changes saved');
            }
            
        }
    }
    
    public function delete($id)
    {
        if ($id) {
            $guest = Children::where('id', $id);
            $this->confirmGuest = false;
            sleep(1);
            $guest->delete();
            if (App::isLocale('ru')) {
                session()->flash('message-guest', 'Ребенок удален');
            } elseif (App::isLocale('en')) {
                session()->flash('message-guest', 'Kid deleted');
            }
        }
    }
}
