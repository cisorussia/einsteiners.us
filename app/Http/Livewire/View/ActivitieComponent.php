<?php

namespace App\Http\Livewire\View;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use App\Models\Activitie;
use App\Models\Categorie;

class ActivitieComponent extends Component
{
    public $activities, $active, $cover_path, $categorie_id, $countrie_id, $citie_id, $name, $description, $date_event, $date_time, $paide_id, $price, $number_volume, $number_available, $location, $tags, $reviewed;
    public $selected_categorie;
    public $categories;

    public $format = 'd.m.Y';

    public function render()
    {
        $this->categories = Categorie::all()->take(10);
        if($this->selected_categorie <= 0) {
            //$this->activities = Activitie::all()->take(20);
            $this->activities = Activitie::where('active', '1')->get()->take(20);
            return view('livewire.activitie.home');
        } else {
            $this->activities = Activitie::where([['categorie_id', $this->selected_categorie], ['active', '1']])->get()->take(20);
            return view('livewire.activitie.home');
        }
    }
    public function selectedCategorie($id)
    {
        sleep(1);
        $this->selected_categorie = $id;
    }
}
