<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /* We have to break indentation in body. sry :) */
    public function run()
    {
        $threads = [
            [
                'user_id' => User::factory()->create(['username' => 'twitch'])->id,
                'category_id' => 1,
                'title' => 'Best Approach to develop Mobile APP of Laravel Website',
                'body' =>
                    'I have a Small website developed in Laravel. Its a sort of shopping cart with features like: Search items, product details page, Cart features, Import product via CSV, Download Cart Contents.
                    Now I want to develop the Mobile APP of this website so that users can use it on their mobile phones and on tablets.
                    Whats the best approach to do this task?
                    1) Do I need to develop only the front end of APP in an framework like VUE, React and then use this website as a backend? In that case how much changing is required at backend.
                    2) What is the other Solution
                    Thanks'
            ],
            [
                'user_id' => User::factory()->create(['username' => 'vayne'])->id,
                'category_id' => 2,
                'title' => 'Eloquent how to set a specific record at the top',
                'body' =>
'I wonder if there is a way to get a collection but have one of these specific record always at the top.
In this collection, I would like a specific id(12) to always show at the top of the collection.
```
$names = DB::table("users")
    ->select("name", "id", "company")
    ->where("id", $user->id)
    ->orderBy("company")
    ->get();
```'
            ],
            [
                'user_id' => User::factory()->create(['username' => 'veigar'])->id,
                'category_id' => 8,
                'title' => 'Check to see if any date field is less than the last day of the month',
                'body' => 'I have a form with expiration dates of about 30 medications. Is it possible in java script to check all date fields on a given page and alert the user prior to submission of the form that a medication is going to expire before the end of the month?'
            ],
            [
                'user_id' => User::factory()->create(['username' => 'thresh'])->id,
                'category_id' => 9,
                'title' => 'Session Regeneration creates annoying 419 error',
                'body' =>
                'Ok, I am using Laravel UI, not Breeze or Jetstream or Fortify. So on my logout function I clear the existing sessions and regenerate to avoid session fixation.
```
public function logout(Request $request){
    Auth::logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return view("auth/logout");
}
```
'
            ],
            [
                'user_id' => User::factory()->create(['username' => 'blitzcrank'])->id,
                'category_id' => 10,
                'title' => 'How to redirect from vue component to laravel blade file.',
                'body' =>
                    'Hello everyone. I am working on a vue.js laravel project. I have used vue-router. I have used a jquery plugin that is not working in vue component. So, I have used the plugin in the blade.php file. Now, I want to redirect from vue component to laravel blade file in order to use that particular plugin which is important for my project. How can I achieve that? What are the ways of achieving the goal?
```
<script>
    export default {
        data:() => {
            return {

            }
        },

        methods: {
            myBook(){
                window.location.href = "api/mybook/pages";
                // this.$router.push("api/mybook/pages");
                // this.$store.dispatch("fetchmybook");
            }
        },
    }
</script>
```'
            ],
        ];

        foreach ($threads as $thread)
            Thread::create($thread);
    }
}
