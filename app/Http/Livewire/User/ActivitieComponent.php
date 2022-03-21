<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\App;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Activitie;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Countrie;
use App\Models\Citie;
use App\Models\Paide;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ActivitieComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    public /*$activities,*/ $user, $users, $categories, $age, $countries, $cities, $paides, $active, $link, $cover_path, $user_id, $categorie_id, $countrie_id, $citie_id, $name, $description, $date_event, $date_time, $paide_id, $price, $number_volume, $number_available, $location, $tags, $reviewed;
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
    public $selectedCountry = false;
    public $selectedPaid = false;
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
        $this->paides = Paide::all();
        $this->categories = Categorie::all();
        $this->countries = Countrie::all();
        $this->user = $user->id;
        if ($user->role_id == '3') {
            $this->adminView = true;
            $this->users = User::all();
            return view('livewire.activitie.activitie', [
                'activities' => Activitie::orderBy('id', 'desc')->paginate(10),
            ]);
        } else {
            return view('livewire.activitie.activitie', [
                'activities' => Activitie::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10),
            ]);
        }
    }

    public function selectedCountry()
    {
        $this->cities = Citie::where('countrie_id', $this->countrie_id)->get();
        $this->selectedCountry = true;
    }

    public function selectedPaid()
    {
        if($this->paide_id == 2) {
            $this->selectedPaid = true;
        } else {
            $this->selectedPaid = false;
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->cover_path = null;
        $this->categorie_id = null;
        $this->age = null;
        $this->countrie_id = null;
        $this->citie_id = null;
        $this->location = null;
        $this->paide_id = null;
        $this->price = null;
        $this->number_volume = null;
        $this->number_available = null;
        $this->date_event = null;
        $this->date_time = null;
        $this->description = null;
        $this->tags = null;
        $this->format = 'd.m.Y';
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
        $date_after = Carbon::today()->format('Y-m-d');
        $date_before = Carbon::today()->addDays(60)->format('Y-m-d');
        
        $this->date_event = Carbon::createFromFormat($this->format, $this->date_event)->timestamp;

        $user = Auth::user();
        //dd($this->categorie_id);
        $this->validate([
            'name' => 'required|min:2',
            'cover_add' => 'required|image|max:1024',
            'categorie_id' => 'required|min:1',
            'age' => 'required|min:1',
            'countrie_id' => 'required|min:1',
            'citie_id' => 'required|min:1',
            'location' => 'required|min:5',
            'paide_id' => 'required|min:1',
            'price' => 'required|min:1',
            'number_volume' => 'required|min:1',
            'number_available' => 'required|min:1',
            'date_event' => 'required|after:' . $date_after . '|before:' . $date_before,
            'description' => 'required|min:5',
            'tags' => 'required|min:5',
        ]);

        Activitie::create([
            'name' => $this->name,
            'cover_path' => $this->cover_add->store('upload/activitie', 'public'),
            'date_event' => $this->date_event,
            'date_time' => $this->date_time,
            'categorie_id' => $this->categorie_id,
            'age' => $this->age,
            'countrie_id' => $this->countrie_id,
            'citie_id' => $this->citie_id,
            'location' => $this->location,
            'paide_id' => $this->paide_id,
            'price' => $this->price,
            'number_volume' => $this->number_volume,
            'number_available' => $this->number_available,
            'description' => $this->description,
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
                'categorie_id' => 'required|min:1',
                'age' => 'required|min:1',
                'countrie_id' => 'required|min:1',
                'citie_id' => 'required|min:1',
                'location' => 'required|min:5',
                'paide_id' => 'required|min:1',
                //'price' => 'required|min:1',
                'number_volume' => 'required|min:1',
                'number_available' => 'required|min:1',
                'date_event' => 'required|after:' . $date_after . '|before:' . $date_before,
                'description' => 'required|min:5',
                'tags' => 'required|min:5',
            ]);
            if ($this->selected_id) {
                $activitie = Activitie::find($this->selected_id);
                $activitie->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'cover_path' => $this->cover_path->store('upload/event', 'public'),
                    'date_event' => $this->date_event,
                    'date_time' => $this->date_time,
                    'categorie_id' => $this->categorie_id,
                    'age' => $this->age,
                    'countrie_id' => $this->countrie_id,
                    'citie_id' => $this->citie_id,
                    'location' => $this->location,
                    'paide_id' => $this->paide_id,
                    'price' => $this->price,
                    'number_volume' => $this->number_volume,
                    'number_available' => $this->number_available,
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
                'categorie_id' => 'required|min:1',
                'age' => 'required|min:1',
                'countrie_id' => 'required|min:1',
                'citie_id' => 'required|min:1',
                'location' => 'required|min:5',
                'paide_id' => 'required|min:1',
                //'price' => 'required|min:1',
                'number_volume' => 'required|min:1',
                'number_available' => 'required|min:1',
                'date_event' => 'required|after:' . $date_after . '|before:' . $date_before,
                'description' => 'required|min:5',
                'tags' => 'required|min:5',
            ]);
            if ($this->selected_id) {
                $activitie = Activitie::find($this->selected_id);
                $activitie->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    //'cover_path' => $this->cover_path->store('upload', 'public'),
                    'date_event' => $this->date_event,
                    'date_time' => $this->date_time,
                    'categorie_id' => $this->categorie_id,
                    'countrie_id' => $this->countrie_id,
                    'age' => $this->age,
                    'citie_id' => $this->citie_id,
                    'location' => $this->location,
                    'paide_id' => $this->paide_id,
                    'price' => $this->price,
                    'number_volume' => $this->number_volume,
                    'number_available' => $this->number_available,
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
        $activitie = Activitie::findOrFail($id);
        $this->cities = Citie::where('countrie_id', $activitie->countrie_id)->get();
        $this->selected_id = $id;
        $this->name = $activitie->name;
        $this->cover_path = $activitie->cover_path;
        $this->categorie_id = $activitie->categorie_id;
        $this->age = $activitie->age;
        $this->countrie_id = $activitie->countrie_id;
        $this->citie_id = $activitie->citie_id;
        $this->location = $activitie->location;
        $this->paide_id = $activitie->paide_id;
        $this->price = $activitie->price;
        $this->number_volume = $activitie->number_volume;
        $this->number_available = $activitie->number_available;
        $this->date_event = $activitie->date_event;
        $this->date_time = $activitie->date_time;
        $this->description = $activitie->description;
        $this->tags = $activitie->tags;
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
        $this->previewAddMode = $this->cover_add->store('upload/activitie', 'public');
    }

    public function updatedCoverPath()
    {
        $this->validate([
            'cover_path' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->previewMode = $this->cover_path->store('upload/activitie', 'public');
        $this->upgradeUpload = true;
    }

    public function deactive($id)
    {
        if ($id) {
            $activitie = Activitie::where('id', $id);
            $this->confirmEvent = false;
            sleep(1);
            $activitie->update([
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
            $activitie = Activitie::where('id', $id);
            $this->confirmEvent = false;
            sleep(1);
            $activitie->update([
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
            $activitie = Activitie::where('id', $id);  
            $image = DB::table('activities')->where('id', $id)->first();
            $this->confirmEvent = false;
            sleep(1);
            $activitie->delete();
        }

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие удаленно');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event deleted');
        }
    }
}
