<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;

class FixChatReferenceIDNull extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chatRooms = Chat::whereNull('reference_id')->get();
        foreach ($chatRooms as $key => $chatRoom) {
            $chatRoomRef = Chat::whereNotNull('reference_id')
                ->where('owner_type', $chatRoom->client_type)
                ->where('client_type', $chatRoom->owner_type)
                ->first();
            // var_dump($chatRoomRef);
            if ($chatRoomRef) {
                $chatRoom->reference_id = $chatRoomRef->id;
                $chatRoom->save();
            } else {
                $chatRoom->delete();
            }
        }
    }
}
