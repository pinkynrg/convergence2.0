<?php namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Http\Requests\CreateEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use Carbon\Carbon;
use Request;
use Form; 
use Auth;

class EquipmentsController extends Controller {
	
	public function index() {
		if (Auth::user()->can('read-all-equipment')) {
			$data['equipments'] = Equipment::paginate(50);
        	$data['title'] = "Equipments";
			return view('equipments/index',$data);
		}
		else return redirect()->back()->withErrors(['Access denied to equipment index page']);		
	}

	public function show($id) {
		if (Auth::user()->can('read-equipment')) {
			$data['menu_actions'] = [Form::editItem(route('equipments.edit', $id),"Edit this equipment")];
			$data['equipment'] = Equipment::find($id);
			$data['title'] = $data['equipment']->company->name." - Equipment ".$data['equipment']->name;
			return view('equipments/show',$data);
		}
		else return redirect()->back()->withErrors(['Access denied to equipment show page']);
	}

	public function create($id) {
        $data['title'] = "Create Equipment";
        $data['equipment_types'] = EquipmentType::all();
        $data['company'] = Company::find($id);
		$data['company']->company_id = $data['company']->id;
		return view('equipments/create', $data);	
	}

	public function store(CreateEquipmentRequest $request) {
		$equipment = Equipment::create($request->all());
        $equipment->warranty_expiration = Carbon::createFromFormat('m/d/Y', $request->get('warranty_expiration'));
        $equipment->save();
		return redirect()->route('companies.show',$request->get('company_id'))->with('successes',['equipment created successfully']);
	}

	public function edit($id) {
		$data['equipment'] = Equipment::find($id);
		$data['title'] = $data['equipment']->company->name." - Equipment ".$data['equipment']->name;
        $data['equipment_types'] = EquipmentType::all();
        $data['company'] = Company::find($data['equipment']->company_id);
		$data['company']->company_id = $data['company']->id;
		return view('equipments/edit',$data);
	}

	public function update($id, UpdateEquipmentRequest $request) {
		$equipment = Equipment::find($id);
        $equipment->update($request->all());
        $equipment->warranty_expiration = Carbon::createFromFormat('m/d/Y', $request->get('warranty_expiration'));
        $equipment->save();
        return redirect()->route('companies.show',$equipment->company_id)->with('successes',['equipment updated successfully']);
	}

	public function destroy() {
		return "equipment destroy method hasn't been created yet";
	}

	public function ajaxEquipmentsRequest($params = "") {
		
        parse_str($params,$params);

		$equipments = Equipment::select("equipments.*");
		$equipments->leftJoin("companies","companies.id","=","equipments.company_id");
		$equipments->leftJoin("equipment_types","equipment_types.id","=","equipments.equipment_type_id");

		// apply search
        if (isset($params['search'])) {
            $equipments->where('name','like','%'.$params['search'].'%');
        }

        // apply ordering
        if (isset($params['order'])) {
    		$equipments->orderByRaw("case when ".$params['order']['column']." is null then 1 else 0 end asc");
            $equipments->orderBy($params['order']['column'],$params['order']['type']);
        }

		$equipments = $equipments->paginate(50);

		$data['equipments'] = $equipments;

        return view('equipments/equipments',$data);
	}
}