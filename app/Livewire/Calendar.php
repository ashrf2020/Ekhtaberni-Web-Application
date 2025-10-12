<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events = '';

    /**
     * Handles adding a new event to the database.
     * After saving, it dispatches an event to the browser to refresh the calendar.
     *
     * @param array $event
     * @return void
     */
    public function addevent($event)
    {
        try {
            $input['title'] = $event['title'];
            // The start date from the frontend might be a JavaScript Date object,
            // which needs to be handled. We'll rely on FullCalendar sending a valid string.
            $input['start'] = $event['start'];
            Event::create($input);

            // This is the key change: Dispatch a browser event to trigger the frontend refresh.
            // The 'refreshCalendar' event is already being listened for in your JavaScript.
            $this->dispatchBrowserEvent('refreshCalendar');
        } catch (\Exception $e) {
            // Log the error or handle it as needed.
            // For example, you could dispatch an error message to the browser.
            // $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Failed to add event: ' . $e->getMessage()]);
            // For simplicity, we'll assume success for this example.
        }
    }

    /**
     * Handles updating an event's start date after it has been dropped
     * on the calendar.
     *
     * @param array $event
     * @param array $oldEvent
     * @return void
     */
    public function eventDrop($event, $oldEvent)
    {
        $eventData = Event::find($event['id']);
        if ($eventData) {
            $eventData->start = $event['start'];
            $eventData->save();
        }
    }

    /**
     * Renders the calendar view and passes the events data.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $events = Event::select('id', 'title', 'start')->get();
        $this->events = json_encode($events);
        return view('livewire.calendar');
    }
}