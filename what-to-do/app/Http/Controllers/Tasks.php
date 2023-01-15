<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\GoogleCalendar\Event;
use Google\Cloud\Speech\V1\SpeechClient;
use Pusher\Pusher;
use Carbon;

class Tasks extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks();
        dd($tasks);
        return view('dashboard', compact('tasks'));
    }
    public function add()
    {
    	return view('/posts/add_post');
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'due_datetime' => 'required'
        ]);
        $date_time = explode("T", $request->due_datetime);
        $date_time = $date_time[0] . ' ' . $date_time[1] . ':00';
    	$task = new Task();
        $event = new Event;

        $task->user_id = auth()->user()->id;
        $task->title = $request->title;
    	$task->description = $request->description;
    	$task->status = $request->status;
        $task->priority = $request->priority;
        $task->by = 'text';
        $task->due_datetime = $request->due_datetime;
        $task->complete_datetime = null;

        $event->name = $request->title;
        $event->description = $request->description;
        $event->startDateTime = Carbon\Carbon::now();
        $event->endDateTime = $request->due_datetime;
        $event->addAttendee([
            'email' => auth()->user()->email,
            'name' => auth()->user()->name,
            'responseStatus' => 'accepted',
        ]);
        $event->addAttendee(['email' => auth()->user()->email]);
        $task->save();
        $event->save();
    	return redirect('/dashboard');
    }
    public function edit(Task $task)
    {
    	if(auth()->user()->id == $task->user_id)
        {
            return view('/posts/edit_post', compact('task'));
        }
        else
        {
            return redirect('/dashboard');
        }
    }
    public function update(Request $request, Task $task)
    {
    	if(isset($_POST['delete']))
        {
    		$task->delete();
    		return redirect('/dashboard');
    	}
    	else
    	{
            $this->validate($request, ['description' => 'required']);
    		$task->description = $request->description;
	    	$task->save();
	    	return redirect('/dashboard');
    	}
    }

    public function complete(Task $task)
    {
        $task->status = 'complete';
        $task->complete_datetime = Carbon\Carbon::now();
        $task->save();
        return redirect('/dashboard');
    }

    public function sendTaskNotification(User $user, Task $task)
    {
        Mail::send('emails.task-notification',
            ['user' => $user, 'task' => $task],
            function($message) use ($user) {
                $message->to($user->email)->subject('Task Reminder');
            }
        );
        $options = array(
            'cluster' => 'YOUR_APP_CLUSTER',
            'useTLS' => true
        );
        $pusher = new Pusher(
            'YOUR_APP_KEY',
            'YOUR_APP_SECRET',
            'YOUR_APP_ID',
            $options
        );
        $data['message'] = 'Your task is due!';
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    public function generatePDF(){

        $users = User::all();
        $pdfContent = '';
        $pdfFileName = 'all_tasks.pdf';

        foreach ($users as $user) {
            $userTasks = Task::where('user_id', $user->id)->get();
            $pdfContent .= $this->getAllUserTasksView($userTasks, $user);
        }
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pdfContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfContent = $dompdf->output();
        file_put_contents($pdfFileName, $pdfContent);
        return response()->download($pdfFileName);
    }

    private function getAllUserTasksView($userTasks, $user)
    {
        return view('file.pdf', [
            'userTasks' => $userTasks,
            'user' => $user
        ])->render();
    }

    public function addTaskByVoice($audioFile)
    {
        $speech = new SpeechClient([
            'credentials' => 'path/to/credentials.json',
        ]);

        $config = [
            'languageCode' => 'en-US',
            'sampleRateHertz' => 16000,
            'encoding' => 'LINEAR16',
        ];

        $response = $speech->recognize(fopen($audioFile, 'r'), $config);
        $transcription = $response->getResults()[0]->getAlternatives()[0]->getTranscript();
        Task::create([
            'title' => $transcription,
            'user_id' => auth()->user()->id,
            'description' => 'Task added by voice',
            'status' => 'pending',
            'priority' => 'High',
            'by' => 'voice',
            'due_datetime' => date('Y-m-d H:i:s', strtotime(now() . ' +1 day')),
            'complete_datetime' => null,
        ]);
        Event::create([
            'name' => $transcription,
            'description' => 'Task added by voice',
            'startDateTime' => date('Y-m-d H:i:s', strtotime(now())),
            'endDateTime' => date('Y-m-d H:i:s', strtotime(now() . ' +1 day')),
            'addAttendee' => [
                'email' => auth()->user()->email,
                'name' => auth()->user()->name,
                'responseStatus' => 'accepted',
            ],
        ]);
    }

}
