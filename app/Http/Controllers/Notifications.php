<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class Notifications extends Controller
{

    public function markAsRead(Request $request)
    {
        $id = $request->input('id');

        // Example: Update notification status to 'read'
        DB::table('notifications')
            ->where('id', $id)
            ->update(['status' => 'read']);

        // Return JSON response indicating success
        return response()->json(['message' => 'Notification marked as read', 'id' => $id], 200);
    }


}
