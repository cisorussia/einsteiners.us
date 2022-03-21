<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Calendar;
use App\Models\Activitie;
use App\Models\Event;
use App\Models\Children;
use Carbon\Carbon;

class DateController extends Controller
{
    public function date()
    {
        /* User date format */
            $user = User::all();
            foreach($user as $element) {
                if(stripos($element->birth, '-') !== false) {
                    if (stripos($element->birth, ':') !== false) {
                        $space = substr($element->birth, 0, 9);
                    } else {
                        $space = $element->birth;
                    }
                    $birth = Carbon::createFromFormat('Y-m-d', $space)->timestamp;
                    $element->update([
                        'birth' => $birth,
                    ]);
                }
                if(stripos($element->vaccine, '-') !== false) {
                    if (stripos($element->vaccine, ':') !== false) {
                        $space = substr($element->vaccine, 0, strrpos($element->vaccine, ' '));
                    } else {
                        $space = $element->vaccine;
                    }
                    $vaccine = Carbon::createFromFormat('Y-m-d', $space)->timestamp;
                    $element->update([
                        'vaccine' => $vaccine
                    ]);
                }
            }
        /* User date format */
        /* Calendar date format */
            $calendar = Calendar::all();
            foreach($calendar as $element) {
                if(stripos($element->date_event, '-') !== false) {
                    if (stripos($element->date_event, ':') !== false) {
                        $space = substr($element->date_event, 0, 9);
                    } else {
                        $space = $element->date_event;
                    }
                    $date = Carbon::createFromFormat('Y-m-d', $space)->timestamp;
                    $element->update([
                        'date_event' => $date,  
                    ]);
                }
            }
        /* Calendar date format */
        /* Activitie date format */
            $activitie = Activitie::all();
            foreach($activitie  as $element) {
                if(stripos($element->date_event, '-') !== false) {
                    if (stripos($element->date_event, ':') !== false) {
                        $space = substr($element->date_event, 0, 9);
                    } else {
                        $space = $element->date_event;
                    }
                    $date = Carbon::createFromFormat('Y-m-d', $space)->timestamp;
                    $element->update([
                        'date_event' => $date,  
                    ]);
                }
            }
        /* Activitie date format */
        /* Event date format */
        $event = Event::all();
        foreach($event as $element) {
            if(stripos($element->date_event, '-') !== false) {
                if (stripos($element->date_event, ':') !== false) {
                    $space = substr($element->date_event, 0, 9);
                } else {
                    $space = $element->date_event;
                }
                $date = Carbon::createFromFormat('Y-m-d', $space)->timestamp;
                $element->update([
                    'date_event' => $date,  
                ]);
            }
        }
        /* Event date format */
        /* Children date format */
        $children = Children::all();
        foreach($children as $element) {
            if(stripos($element->birthday, '-') !== false) {
                if (stripos($element->birthday, ':') !== false) {
                    $space = substr($element->birthday, 0, 9);
                } else {
                    $space = $element->birthday;
                }
                $date = Carbon::createFromFormat('Y-m-d', $space)->timestamp;
                $element->update([
                    'birthday' => $date,  
                ]);
            }
        }
        /* Children date format */
        return 'Даты переведены в Unix Timestamp';
    }

}
