<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BotManController extends Controller
{


    public function handle(Request $request)
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {
            if ($message == 'hi') {
                $this->askName($botman);
            } else {
                $botman->reply('Start a conversation by saying hi...');
            }
        });

        $botman->listen();
    }

    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function ($answer, $botman) {
            $name = $answer->getText();
            if ($name != null) {
                $botman->say('Hi '.$name);
                $question = Question::create('How can I help you?')
                    ->addButtons([
                        Button::create('Room Price?')->value('price'), // Corrected button value
                        Button::create('Available rooms today?')->value('available_rooms_today'),
                        // Add other buttons/options as needed
                    ]);

                $botman->ask($question, function ($answer, $botman) {
                    $selectedOption = $answer->getText(); // Get text instead of value
                    $botman->reply("DEBUG: You selected: " . json_encode($selectedOption));
                    // Use getValue() to retrieve the button value

                    if ($selectedOption === 'available_rooms_today') {
                        $checkin_date = Carbon::now()->toDateString();

                        $availableRooms = DB::select("SELECT * FROM rooms WHERE id NOT IN ( SELECT room_id FROM bookings WHERE check_in_date = CURRENT_DATE );");

                        if (!empty($availableRooms)) {
                            $reply = "Available rooms:\n";

                            foreach ($availableRooms as $room) {
                                $roomType = DB::table('room_types')->where('id', $room->room_type_id)->first();
                                $reply .= "Room: $room->title, Room Type: $roomType->title\n"; // Append instead of overwrite
                            }

                            $botman->say($reply); // Send the message once
                        } else {
                            $botman->say('Sorry, no rooms are available for the specified date.');
                        }

                    } elseif ($selectedOption === 'price') { // Corrected condition
                        $rooms = DB::select('SELECT * FROM room_types');

                        if (! empty($rooms)) {
                            $reply = "Room Prices:\n";
                            foreach ($rooms as $room) {
                                $reply .= "Room : $room->title, Price: $room->price\n"; // Use .= to append to the reply
                                $botman->say($reply); // Use botman->reply to send the message
                            }

                        } else {
                            $botman->say('Sorry, No rooms found.');
                        }
                    } else {
                        $botman->say("I'm sorry, I didn't understand that request.");
                    }
                });
            } else {
                $botman->say('Sorry, Please mention your name');
            }
        });
    }
}
