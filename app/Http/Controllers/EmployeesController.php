<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
Use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
    protected $bloods = array(
        '' => '', 
        'A+' => 'A+', 
        'A-' => 'A-',
        'B+' => 'B+', 
        'B-' => 'B-',
        'O+' => 'O+', 
        'O-' => 'O-',
        'AB+' => 'AB+', 
        'AB-' => 'AB-',
    );

    protected $civil_status = array(
        '' => '', 
        'Single' => 'Single', 
        'Married' => 'Married', 
        'Windowed' => 'Windowed', 
        'Divorced' => 'Divorced', 
        'Separated' => 'Separated', 
    );

    protected $living_arrangement = array(
        'Rented' => 'Rented', 
        'Owned' => 'Owned', 
    );

    protected $employment_status = array(
        'Provisionary' => 'Provisionary', 
        'Regular' => 'Regular', 
        'Resigned' => 'Resigned', 
    );

    protected $nationals = array(
        'Afghan',
        'Albanian',
        'Algerian',
        'American',
        'Andorran',
        'Angolan',
        'Antiguans',
        'Argentinean',
        'Armenian',
        'Australian',
        'Austrian',
        'Azerbaijani',
        'Bahamian',
        'Bahraini',
        'Bangladeshi',
        'Barbadian',
        'Barbudans',
        'Batswana',
        'Belarusian',
        'Belgian',
        'Belizean',
        'Beninese',
        'Bhutanese',
        'Bolivian',
        'Bosnian',
        'Brazilian',
        'British',
        'Bruneian',
        'Bulgarian',
        'Burkinabe',
        'Burmese',
        'Burundian',
        'Cambodian',
        'Cameroonian',
        'Canadian',
        'Cape Verdean',
        'Central African',
        'Chadian',
        'Chilean',
        'Chinese',
        'Colombian',
        'Comoran',
        'Congolese',
        'Costa Rican',
        'Croatian',
        'Cuban',
        'Cypriot',
        'Czech',
        'Danish',
        'Djibouti',
        'Dominican',
        'Dutch',
        'East Timorese',
        'Ecuadorean',
        'Egyptian',
        'Emirian',
        'Equatorial Guinean',
        'Eritrean',
        'Estonian',
        'Ethiopian',
        'Fijian',
        'Filipino',
        'Finnish',
        'French',
        'Gabonese',
        'Gambian',
        'Georgian',
        'German',
        'Ghanaian',
        'Greek',
        'Grenadian',
        'Guatemalan',
        'Guinea-Bissauan',
        'Guinean',
        'Guyanese',
        'Haitian',
        'Herzegovinian',
        'Honduran',
        'Hungarian',
        'I-Kiribati',
        'Icelander',
        'Indian',
        'Indonesian',
        'Iranian',
        'Iraqi',
        'Irish',
        'Israeli',
        'Italian',
        'Ivorian',
        'Jamaican',
        'Japanese',
        'Jordanian',
        'Kazakhstani',
        'Kenyan',
        'Kittian and Nevisian',
        'Kuwaiti',
        'Kyrgyz',
        'Laotian',
        'Latvian',
        'Lebanese',
        'Liberian',
        'Libyan',
        'Liechtensteiner',
        'Lithuanian',
        'Luxembourger',
        'Macedonian',
        'Malagasy',
        'Malawian',
        'Malaysian',
        'Maldivan',
        'Malian',
        'Maltese',
        'Marshallese',
        'Mauritanian',
        'Mauritian',
        'Mexican',
        'Micronesian',
        'Moldovan',
        'Monacan',
        'Mongolian',
        'Moroccan',
        'Mosotho',
        'Motswana',
        'Mozambican',
        'Namibian',
        'Nauruan',
        'Nepalese',
        'New Zealander',
        'Nicaraguan',
        'Nigerian',
        'Nigerien',
        'North Korean',
        'Northern Irish',
        'Norwegian',
        'Omani',
        'Pakistani',
        'Palauan',
        'Panamanian',
        'Papua New Guinean',
        'Paraguayan',
        'Peruvian',
        'Polish',
        'Portuguese',
        'Qatari',
        'Romanian',
        'Russian',
        'Rwandan',
        'Saint Lucian',
        'Salvadoran',
        'Samoan',
        'San Marinese',
        'Sao Tomean',
        'Saudi',
        'Scottish',
        'Senegalese',
        'Serbian',
        'Seychellois',
        'Sierra Leonean',
        'Singaporean',
        'Slovakian',
        'Slovenian',
        'Solomon Islander',
        'Somali',
        'South African',
        'South Korean',
        'Spanish',
        'Sri Lankan',
        'Sudanese',
        'Surinamer',
        'Swazi',
        'Swedish',
        'Swiss',
        'Syrian',
        'Taiwanese',
        'Tajik',
        'Tanzanian',
        'Thai',
        'Togolese',
        'Tongan',
        'Trinidadian/Tobagonian',
        'Tunisian',
        'Turkish',
        'Tuvaluan',
        'Ugandan',
        'Ukrainian',
        'Uruguayan',
        'Uzbekistani',
        'Venezuelan',
        'Vietnamese',
        'Welsh',
        'Yemenite',
        'Zambian',
        'Zimbabwean'
);

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $selected = null;

        if(isset($request->applicant_id)) {
            $selected = $request->applicant_id;
        }

        $data['applicants'] = Applicant::where('status','Qualified')
        ->where('is_hired', false)
        ->get()
        ->pluck('full_name','id')
        ->prepend('Please Select','');


        $data['selected'] = $selected;
        $data['bloods'] = $this->bloods;    
        $data['civil_status'] = $this->civil_status;
        $data['living_arrangement'] = $this->living_arrangement;
        $data['employment_status'] = $this->employment_status;
        $data['nationals'] = $this->nationals;
        $data['title'] = 'Add Employee (201)';

        $html = view('employees.create', $data)->render();
        return response()->json($html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      

        $validator = Validator::make($request->all(), [
            'applicant'=>'required|unique:employees,applicant_id',
            'first_name'=>'required',
            'last_name'=>'required',
            'nick_name'=>'required',
            'contact'=>'required',
            'gender'=>'required',
            'birthday'=>'required',
            'living_arrangement'=>'required',
            'nationality'=>'required',
            'civil_status'=>'required',
            'blood_type'=>'required',
            'status'=>'required',
            'hire_date'=>'required',
            'salary'=>'required|numeric',
            'password'=>'required|min:5',
            'email'=>'required|email|unique:users',
            'formal_picture'=>'mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $applicant = Applicant::findOrFail($request->get('applicant'));
        $count = Employees::all()->count() + 1;
        $count = str_pad($count,'6','0',STR_PAD_LEFT);

        if($applicant->is_hired == false) {
            $employee = new Employees();
            $employee->salary = $request->get('salary');
            $employee->contact = $request->get('contact');
            $employee->email = $request->get('email');
            $employee->gender = $request->get('gender');
            $employee->applicant_id = $request->get('applicant');
            $employee->employee_no = 'EMP-'.$count;
            $employee->status = $request->get('status');
            $employee->birthday = $request->get('birthday');
            $employee->birthplace = $request->get('birthplace');
            $employee->present_address = $request->get('present_address');
            $employee->provicial_address = $request->get('provicial_address');
            $employee->living_arrangement = $request->get('living_arrangement');
            $employee->first_name = $request->get('first_name');
            $employee->middle_name = $request->get('middle_name');
            $employee->last_name = $request->get('last_name');
            $employee->nick_name = $request->get('nick_name');
            $employee->civil_status = $request->get('civil_status');
            $employee->nationality = $this->nationals[$request->get('nationality')];
            $employee->blood_type = $request->get('blood_type');
            $employee->hire_date = $request->get('hire_date');

            if ($request->hasFile('formal_picture')) {
                $path = $request->file('formal_picture')->store('files/201/picture/','s3');
                Storage::disk('s3')->setVisibility($path,'public');
                $employee->formal_picture = Storage::disk('s3')->url($path);
            }

            $employee->save();

            $user = new User();
            $user->name = $employee->nick_name;
            $user->password = Hash::make($request->get('password'));    
            $user->employee_id = $employee->id; 
            $user->email = $employee->email; 
            $user->save();

            $applicant->is_hired = true;
            $applicant->save();

        }

        return response()->json(['success' => true, 'employee' => $employee, 'user' => $user, 'applicant'=> $applicant]);
        // return redirect()->back()->with('success', 'Thank you');   

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $get_employee = Employees::findOrFail($id);
        return view('employees.view', ['employee' => $get_employee]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($employee)
    {
        //
        $get_employee = Employees::findOrFail($employee);
        return view('employees.edit', ['employee' => $get_employee]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'applicant'=>'required',
            
            'first_name'=>'required',
            'last_name'=>'required',
            'nick_name'=>'required',
            'contact'=>'required',
            'gender'=>'required',
            'birthday'=>'required',
            'living_arrangement'=>'required',
            'present_address'=>'required',
            'provicial_address'=>'required',
            'nationality'=>'required',
            'civil_status'=>'required',
            'blood_type'=>'required',
            'status'=>'required',
            'hire_date'=>'required',

            'email'=>'required|email|unique:employees,email,'. $id
        ]);


        // $employee = Employees::findOrFail($id);
        // $employee->name = $request->get('name');
        // $employee->address = $request->get('address');
        // $employee->salary = $request->get('salary');
        // $employee->contact = $request->get('contact');
        // $employee->email = $request->get('email');
        // $employee->gender = $request->get('gender');
        // $employee->name = $request->get('name');
        // $employee->save();
        // return redirect('/')->with('success', 'Record updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        // $employee = Employees::findOrFail($id);
        // $employee->delete();

        // return redirect('/')->with('success', 'Successfully deleted the employee!');
    }
}
