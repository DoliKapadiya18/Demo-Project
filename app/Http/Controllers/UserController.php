<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
//use App\Http\Controllers\Datatables;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');

            // if ($request->has('start_date') && $request->has('end_date')) {
            //     $startDate = $request->input('start_date');
            //     $endDate = $request->input('end_date');
            //     $data->whereDate('created_at', '>=', $startDate)
            //           ->whereDate('created_at', '<=', $endDate);
            // }

            // if($request->filled('from_date') && $request->filled('to_date'))
            // {
            //     $data = $data->whereBetween('created_at',[$request->from_date, $request->to_date]);
            // }

            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
                            $btn = '<a href="' . route('users.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                            // $btn = $btn.'<a href="' . route('users.destroy', $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';
                            return $btn;
                    })
                    // ->filterColumn('state', function($query, $keyword) {
                    //     $query->where('state', 'like', "%$keyword%");
                    // })
                    // ->filterColumn('city', function($query, $keyword) {
                    //     $query->where('city', 'like', "%$keyword%");
                    // })
                    ->editColumn('address', function(User $user) {
                        return $user->address." ".'<button class="copy-btn" data-value="' . $user->address . '"><i class="fa fa-clone"></i></button>';


                        // return $user->address . '<button value="copy" onclick="copyToClipboard()"><i class="fa fa-clone"></i></button>';
                    })
                    ->rawColumns(['address','action'])
                    ->make(true);
        }
          
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {     
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/|max:25',
            'email' => 'required|email:rfc,dns|unique:users|max:50',
            'gender'=> 'required',
            'state' => 'required|regex:/^[a-zA-Z]+$/|min:3|max:40',
            'city' => 'required|regex:/^[a-zA-Z]+$/|min:3|max:40',
            'address'=> 'required',
            'password' => [
                'required', 'confirmed',
                Password::min(10)->letters()->numbers()->mixedCase()->symbols()
            ]
        ]);
        
        //dd($request->all());

        $user->name = $request->name;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->address = $request->address .", ". $request->address2;
        $user->password = Hash::make($request->password);

        $user->save();
        
        //User::create($request->all());
         
        return redirect()->route('users.index')->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/|max:25',
            'email' => 'required|email:rfc,dns|unique:users|max:50',
            'password' => [
                'required', 'confirmed',
                Password::min(10)->letters()->numbers()->mixedCase()->symbols()
            ]
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->update();
        
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // $user->delete();
         
        // return redirect()->route('users')->with('success','User deleted successfully');
    }

    public function stateSearching(Request $request)
    {
        $query = $request->get('state_name');

        $filterResult = State::where('name', 'LIKE', '%'. $query. '%')->get();

        return response()->json($filterResult);
    }

    public function citySearching(Request $request)
    {
        $query = $request->get('city_name');

        $filterResult = City::where('name', 'LIKE', '%'. $query. '%')->get();

        return response()->json($filterResult);
    }
}
