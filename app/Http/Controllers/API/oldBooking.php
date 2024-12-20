<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class Booking extends BaseController
{
	/**
	 * Register api
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $action)
	{
		switch ($action) {
			case 'list':
				$validator = Validator::make($request->all(), [
					'user_id' => 'required'
				]);
				$data = $request->all();
				$user_id = isset($data['user_id']) ? $data['user_id'] : null;
				if ($validator->fails()) {
					return $this->sendError('Validation Error.', $validator->errors());
				}
				$booking_list = $this->bookingList($user_id);
				if ($booking_list) {
					return $this->sendResponse($booking_list, 'success.');
				} else {
					return $this->sendError('Error.', ['error' => 'something went wrong']);
				}
				break;
			case 'cancel':
				$validator = Validator::make($request->all(), [
					'user_id' => 'required'
				]);
				$data = $request->all();
				$user_id = isset($data['user_id']) ? $data['user_id'] : null;
				$booking_id = isset($data['booking_id']) ? $data['booking_id'] : null;
				if ($validator->fails()) {
					return $this->sendError('Validation Error.', $validator->errors());
				}
				$update = DB::table('booking')->where(['booking_id' => $booking_id, 'customer_id' => $user_id])->update(['status' => 3]);
				$update_history = [
					"booking_id" => $booking_id,
					"action" => "BOOKING CANCELLED_BY_USER",
					"user_id" => $user_id
				];
				DB::table('booking_history')->insert($update_history);
				if ($update) {
					return $this->sendResponse(null, 'booking cancelled');
				} else {
					return $this->sendError('Error.', ['error' => 'something went wrong']);
				}
				break;
			case 'details':
				$validator = Validator::make($request->all(), [
					'user_id' => 'required'
				]);
				$data = $request->all();
				$user_id = isset($data['user_id']) ? $data['user_id'] : null;
				$booking_id = isset($data['booking_id']) ? $data['booking_id'] : null;
				if ($validator->fails()) {
					return $this->sendError('Validation Error.', $validator->errors());
				}
				$booking_list = $this->bookingList($user_id, $booking_id);
				if ($booking_list) {
					return $this->sendResponse($booking_list, 'success.');
				} else {
					return $this->sendError('Error.', ['error' => 'something went wrong']);
				}
				break;
			case 'calculation':
				$validator = Validator::make($request->all(), [
					'user_id' => 'required',
					'distance' => 'required',
					'category' => 'required',
					'pincode' => 'required'
				]);
				if ($validator->fails()) {
					return $this->sendError('Validation Error.', $validator->errors());
				}
				$data = $request->all();
				$category = isset($data['category']) ? $data['category'] : null;
				$distance = isset($data['distance']) ? $data['distance'] : null;
				$pincode = isset($data['pincode']) ? $data['pincode'] : null;
				$res_data = $this->calculation($category, $distance, $pincode);
				if ($res_data) {
					return $this->sendResponse($res_data, 'success.');
				} else {
					return $this->sendError('Error.', ['error' => 'something went wrong']);
				}
				break;
			case 'create':
				$validator = Validator::make($request->all(), [
					'user_id' => 'required',
					'distance' => 'required',
					'category' => 'required',
					'from_location' => 'required',
					'to_location' => 'required',
					'pincode' => 'required'
				]);
				if ($validator->fails()) {
					return $this->sendError('Validation Error.', $validator->errors());
				}
				$input = $request->all();
				$booking_id = $this->create($input);
				if ($booking_id) {
					return $this->sendResponse($booking_id, 'success.');
				} else {
					return $this->sendError('Error.', ['error' => 'something went wrong']);
				}
				break;
			default:
				break;
		}
	}
	public function bookingList($user_id, $booking_id = null)
	{
		$booking_data = DB::table('booking')->where('customer_id', '=', $user_id)->select('driver_id', 'booking_id', 'customer_id', 'payment_id', 'status', 'category', 'distance', 'pincode');
		if ($booking_id) {
			$booking_data = $booking_data->where('booking_id', $booking_id);
		}
		$booking_data = $booking_data->get()->toArray();
		$result = [];
		if ($booking_data) {
			$booking_location_data = $location_payment_data = $driver_data = [];
			$booking_ids = array_column($booking_data, 'booking_id');
			$driver_array = array_column($booking_data, 'driver');
			if ($driver_array) {
				$driver_result = DB::table('driver')->whereIn('id', $driver_array)->select('id', 'name', 'phone', 'email', 'limage', 'aimage', 'pincode', 'address')->get()->toArray();
				if ($driver_result) {
					foreach ($driver_result as $elem) {
						$driver_data[$elem->id] = $elem;
					}
				}
			}
			$location_data = DB::table('booking_location_mapping')->whereIn('booking_id', $booking_ids)->select('booking_id', 'start_location_id', 'end_location_id')->get()->toArray();
			$location_payment_data_query = DB::table('booking_payment')->whereIn('booking_id', $booking_ids)->select('booking_id', 'type', 'base_price', 'tax', 'round_off', 'total', 'transaction_id', 'tax_split_1', 'tax_split_2')->get()->toArray();

			if ($location_payment_data_query) {
				foreach ($location_payment_data_query as $elem) {
					$location_payment_data[$elem->booking_id] = $elem;
				}
			}
			if ($location_data) {
				$start_location_ids = array_column($location_data, 'start_location_id');
				$end_location_ids = array_column($location_data, 'end_location_id');
				$locations_ids = array_merge($start_location_ids, $end_location_ids);
				$locations_datas = DB::table('booking_locations')->whereIn('booking_id', $booking_ids)->select('address1', 'address2', 'address3', 'city', 'state', 'country', 'postal_code', 'lat', 'long', 'landmark', 'location_id', 'booking_id')->get()->toArray();
				if ($locations_datas) {
					foreach ($locations_datas as $elem) {
						if (in_array($elem->location_id, $start_location_ids)) {
							$booking_location_data[$elem->booking_id]['from_locations'] = $elem;
						}
						if (in_array($elem->location_id, $end_location_ids)) {
							$booking_location_data[$elem->booking_id]['to_locations'][] = $elem;
						}
					}
				}
			}
			foreach ($booking_data as $elem) {
				$elem->from_locations = isset($booking_location_data[$elem->booking_id]['from_locations']) ? $booking_location_data[$elem->booking_id]['from_locations'] : [];
				$elem->to_locations = isset($booking_location_data[$elem->booking_id]['to_locations']) ? $booking_location_data[$elem->booking_id]['to_locations'] : null;;
				$elem->payment_data = isset($location_payment_data[$elem->booking_id]) ? $location_payment_data[$elem->booking_id] : null;
				$elem->driver_data = isset($driver_data[$elem->driver_id]) ? $driver_data[$elem->driver_id] : [];
				$result[] = $elem;
			}
		}
		return $result;
	}
	public function taxCalculation($price, $taxRate)
	{
		$price = (float)$price;
		$taxRate = (float)$taxRate;
		$tax = $price * $taxRate / 100;
		$total = $price + $tax;
		if ($total == 0) {
			return $total;
		}
		$calculatedTaxRate = (($total - $price) / $price) * 100;
		return $priceExclVAT = (float)round($calculatedTaxRate, 2);
	}
	public function calculation($category, $distance, $pincode)
	{

		$data =  DB::table('price')->where(['category' => $category, 'pincode' => $pincode])->select('amount', 'tax_split_1', 'tax_split_2', 'tax')->first();

		$base_price = isset($data->amount) ? $data->amount : "";
		$tax_split_amount_1 = isset($data->tax_split_1) ? $data->tax_split_1 : "";
		$tax_split_amount_2 = isset($data->tax_split_2) ? $data->tax_split_2 : "";
		$tax = isset($data->tax) ? $data->tax : "";
		$tax = $this->taxCalculation($base_price, $tax);
		$total = (float)$tax + (float)$base_price;
		return ['total' => $total, 'base_price' => $base_price, 'tax_split_1' => $this->taxCalculation($base_price, $tax_split_amount_1), 'tax_split_2' => $this->taxCalculation($base_price, $tax_split_amount_2), 'tax' => $this->taxCalculation($base_price, $tax)];
	}
	/**
	 * create new booking
	 * */
	public function create($data)
	{
		$from_location = isset($data['from_location']) ? $data['from_location'] : null;
		$to_location = isset($data['to_location']) ? $data['to_location'] : null;
		$user_id = isset($data['user_id']) ? $data['user_id'] : null;
		$category = isset($data['category']) ? $data['category'] : null;
		$distance = isset($data['distance']) ? $data['distance'] : null;
		$base_price = isset($data['base_price']) ? $data['base_price'] : null;
		$tax = isset($data['tax']) ? $data['tax'] : null;
		$total = isset($data['total']) ? $data['total'] : null;
		$round_off = isset($data['round_off']) ? $data['round_off'] : null;
		$pincode = isset($data['pincode']) ? $data['pincode'] : null;

		$booking_id = 'doc-' . $this->guidv4();
		$booing_insert_data = [
			"booking_id" => $booking_id,
			"customer_id" => $user_id,
			"category" => $category,
			"distance" => $distance,
			"pincode" => $pincode
		];

		$update_address_data = $to_location_ids = [];
		$from_location_id = 'loc-' . time() . '-' . mt_rand();
		foreach ($to_location as $key => $elem) {
			$unique_location_Id = 'loc-' . time() . '-' . mt_rand();
			$to_location_ids[] = $unique_location_Id;
			$update_address_data[$key]['location_id'] = $unique_location_Id;
			$update_address_data[$key]['booking_id'] = $booking_id;

			if (isset($elem['address1']))
				$update_address_data[$key]['address1'] = $elem['address1'];

			if (isset($elem['address2']))
				$update_address_data[$key]['address2'] = $elem['address2'];

			if (isset($elem['address3']))
				$update_address_data[$key]['address3'] = $elem['address3'];

			if (isset($elem['city']))
				$update_address_data[$key]['city'] = $elem['city'];

			if (isset($elem['state']))
				$update_address_data[$key]['state'] = $elem['state'];

			if (isset($elem['country']))
				$update_address_data[$key]['country'] = $elem['country'];

			if (isset($elem['postal_code']))
				$update_address_data[$key]['postal_code'] = $elem['postal_code'];

			if (isset($elem['lat']))
				$update_address_data[$key]['lat'] = $elem['lat'];

			if (isset($elem['long']))
				$update_address_data[$key]['long'] = $elem['long'];

			if (isset($elem['landmark']))
				$update_address_data[$key]['landmark'] = $elem['landmark'];
		}

		$key = $key + 1;

		$update_address_data[$key]['location_id'] = $from_location_id;
		$update_address_data[$key]['booking_id'] = $booking_id;

		if (isset($data['from_location']['address1']))
			$update_address_data[$key]['address1'] = $data['from_location']['address1'];

		if (isset($data['from_location']['address2']))
			$update_address_data[$key]['address2'] = $data['from_location']['address2'];

		if (isset($data['from_location']['address3']))
			$update_address_data[$key]['address3'] = $data['from_location']['address3'];

		if (isset($data['from_location']['city']))
			$update_address_data[$key]['city'] = $data['from_location']['city'];

		if (isset($data['from_location']['state']))
			$update_address_data[$key]['state'] = $data['from_location']['state'];

		if (isset($data['from_location']['country']))
			$update_address_data[$key]['country'] = $data['from_location']['country'];

		if (isset($data['from_location']['postal_code']))
			$update_address_data[$key]['postal_code'] = $data['from_location']['postal_code'];

		if (isset($data['from_location']['lat']))
			$update_address_data[$key]['lat'] = $data['from_location']['lat'];

		if (isset($data['from_location']['long']))
			$update_address_data[$key]['long'] = $data['from_location']['long'];

		if (isset($data['from_location']['landmark']))
			$update_address_data[$key]['landmark'] = $data['from_location']['landmark'];

		$update_location_mapping = [];
		foreach ($to_location_ids as $elem) {
			$update_location_mapping[] = [
				"booking_id" => $booking_id,
				"start_location_id" => $from_location_id,
				"end_location_id" => $elem
			];
		}
		$price_data = $this->calculation($category, $distance, $pincode);
		$base_price = isset($price_data['base_price']) ? (float)$price_data['base_price'] : 0;
		$tax = isset($price_data['tax']) ? (float)$price_data['tax'] : 0;
		$tax_split_1 = isset($price_data['tax_split_1']) ? (float)$price_data['tax_split_1'] : 0;
		$tax_split_2 = isset($price_data['tax_split_2']) ? (float)$price_data['tax_split_2'] : 0;
		$update_payment = [
			"booking_id" => $booking_id,
			"base_price" => $base_price,
			"tax" => $tax,
			"tax_split_1" => $tax_split_1,
			"tax_split_2" => $tax_split_2,
			"total" => $total
		];

		$update_history = [
			"booking_id" => $booking_id,
			"action" => "BOOKING CREATE",
			"user_id" => $user_id
		];


		if ($booing_insert_data) {
			DB::table('booking')->insert($booing_insert_data);
		}
		if ($update_address_data) {
			DB::table('booking_locations')->insert($update_address_data);
		}
		if ($update_payment) {
			DB::table('booking_payment')->insert($update_payment);
		}
		if ($update_history) {
			DB::table('booking_history')->insert($update_history);
		}
		if ($update_location_mapping) {
			DB::table('booking_location_mapping')->insert($update_location_mapping);
		}


		return $booking_id;
	}
}
