<?php

namespace App\Http\Livewire\View;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Activitie;
use App\Models\Categorie;

class ActivitielistComponent extends Component
{
    use WithPagination;
    
    public $activities, $active, $cover_path, $categorie_id, $countrie_id, $citie_id, $name, $description, $date_event, $date_time, $paide_id, $price, $number_volume, $number_available, $location, $tags, $reviewed;
    public $selected_categorie;
    public $categories;

    public $format = 'd.m.Y';

    public function render()
    {
        $this->categories = Categorie::all()->take(10);
        if($this->selected_categorie <= 0) {
            //$this->activities = Activitie::all();
            $this->activities = Activitie::where('active', '1')->get()->take(20);
            return view('livewire.activitie.list');
            /*
            return view('livewire.activitie.list', [
                'activities' => Activitie::paginate(10),
            ]);
            */
        } else {
            $this->activities = Activitie::where([['categorie_id', $this->selected_categorie], ['active', '1']])->get();
            return view('livewire.activitie.list');
        }
    }
    public function selectedCategorie($id)
    {
        sleep(1);
        $this->selected_categorie = $id;
    }
}
