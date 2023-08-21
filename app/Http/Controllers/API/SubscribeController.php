<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscribeRequest;
use App\Models\User;
use App\Models\Website;
use App\Notifications\SubscriptionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubscribeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreSubscribeRequest $request, Website $website)
    {
        $user = User::firstOrCreate($request->only('email'),[
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        if ($website->subscriptions()->where('user_id', $user->id)->exists()){
            return response()->json(['message' => 'You have already subscribed for this website!']);
        }

        $website->subscriptions()->create(['user_id' => $user->id]);

        $user->notify(new SubscriptionNotification());

        return  response()->json(['message' => "Congrats, now you subscribe for {$website->sub_domain} site."]);
    }
}
