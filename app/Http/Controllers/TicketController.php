<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Category;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user()->role->pluck('id')->toArray();

        // dd($users[0] == '1');
        if ($users[0] == '1') {
            $agentUsers = Role::where('id', 2)->first();
            $agents = $agentUsers->users;
            // dd($agents);
            $tickets = Ticket::with('labels', 'categories')->get();
            return view('ticket.view-ticket', compact('tickets', 'users', 'agents'));
        } elseif ($users[0] == '2') {
            $tickets = Ticket::with('labels', 'categories')->where('assigned_to', '=', Auth::id())->get();
            // dd(is_null($ticket->assigned_to));
            if ($tickets->where('assigned_to' == !null)) {
                return view('ticket.view-ticket', compact('tickets', 'users'));
            } else {
                $output = '<div class="alert alert-warning" id="alert-box" role="alert"><strong>Warning! No Tickets.!!</strong></div>';
                return view('ticket.view-ticket', compact('tickets', 'users'))->with('message', $output);
            }
        } elseif ($users[0] == '3') {
            $tickets = Ticket::with('labels', 'categories')->where('user_id', '=', Auth::id())->get();
            return view('ticket.view-ticket', compact('tickets', 'users'));
            // dd($tickets);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Auth::user()->role->pluck('id')->toArray();
        $labels = Label::all();
        $categories = Category::all();
        $data = compact('labels', 'categories', 'users');
        return view('ticket.create-new-ticket')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'message' => 'required',
            'label' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('ticket_uploads'), $imageName);
        $ticket = new Ticket();
        $ticket->name = $request['name'];
        $ticket->message = $request['message'];
        $ticket->label = $request['label'];
        $ticket->category = $request['category'];
        $ticket->priority = $request['priority'];
        $ticket->image = $imageName;
        $ticket->user_id = Auth::id();
        // dd($ticket);
        $ticket->save();
        return redirect('ticket/view-ticket');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::find($id);
        return view('ticket.show-ticket')->with(compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $labels = Label::all();
        $categories = Category::all();
        $ticket = Ticket::find($id);
        $data = compact('ticket', 'labels', 'categories');
        return view('ticket.create-new-ticket')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::find($id);
        $validated = $request->validate([
            'name' => 'required',
            'message' => 'required',
            'label' => 'required',
            'category' => 'required',
            'priority' => 'required',
        ]);

        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('ticket_uploads'), $imageName);
            $ticket->image = $imageName;
        }
        $ticket->name = $request['name'];
        $ticket->message = $request['message'];
        $ticket->label = $request['label'];
        $ticket->category = $request['category'];
        $ticket->priority = $request['priority'];
        // dd($ticket);
        $ticket->save();

        return redirect('ticket/view-ticket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect('ticket/view-ticket');
    }

    public function assignToAgent(Request $request)
    {
        $ticket = Ticket::find($request->ticketId);
        $user = User::find($request->getAgent);
        $data = [];
        $result = '';
        if ($request->ajax()) {

            if ($request->getAgent == 'Assign To') {
                $ticket->assigned_to = null;
                $ticket->save();
                $result = '
                <div class="alert alert-danger fade show" id="alert-box" role="alert">
                    <strong>Warning!</strong> Not Assigned Yet.!!
                    <div class="float-end">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>';
            } else {
                // dd($user);
                // dd("Agent Id: ". $request->getAgent);
                // dd($ticket);

                $ticket->assigned_to = $request->getAgent;
                $ticket->save();
                $result = '
                <div class="alert alert-success fade show" id="alert-box" role="alert">
                    <strong>Success!</strong> Assigned To ' . $user->name  .  '.!!
                    <div class="float-end">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>';

                // dd($result);
            }
            array_push($data, $request->ticketId, $result);

            return response()->json($data);
        }
    }

    public function viewLog () {
        $users = Auth::user()->role->pluck('id')->toArray();
        if($users[0] == '1') {
            $tickets = Ticket::with('labels', 'categories', 'users')->get();
            return view('admin.logs.ticket-logs', compact('tickets', 'users'));
        }
        else {
            return redirect(route('view-ticket'));
        }
    }

}
