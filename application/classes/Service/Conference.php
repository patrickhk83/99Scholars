<?php defined('SYSPATH') or die('No direct script access.');

class Service_Conference {

	public function list_all($page = 0, $limit = 20)
	{
		return $this->populate();
	}

	public function list_by($category, $accept_abstract, $start_date, $end_date, $type, $country, $page, $limit = 20)
	{
		$has_condition = false;

		$sql = "select * from conference as c where ";

		if(isset($category) && !empty($category))
		{
			$sql = $sql."(c.id in (select conference from category_conference where category in (".$category."))) ";
			$has_condition = true;
		}

		if(isset($accept_abstract) && $accept_abstract)
		{
			if($has_condition)
			{
				$sql = $sql."and ";
			}
			else
			{
				$has_condition = true;
			}

			$sql = $sql."(curdate() < c.deadline) ";
		}

		if(isset($start_date) && !empty($start_date))
		{
			if($has_condition)
			{
				$sql = $sql."and ";
			}
			else
			{
				$has_condition = true;
			}

			$sql = $sql."('".$start_date."' >= c.start_date) ";
		}

		if(isset($end_date) && !empty($end_date))
		{
			if($has_condition)
			{
				$sql = $sql."and ";
			}
			else
			{
				$has_condition = true;
			}

			$sql = $sql."('".$end_date."' <= c.end_date) ";
		}

		if(isset($type) && !empty($type))
		{
			if($has_condition)
			{
				$sql = $sql."and ";
			}
			else
			{
				$has_condition = true;
			}

			$sql = $sql."(c.type in (".$type.")) ";
		}

		if(isset($country) && !empty($country))
		{
			if($has_condition)
			{
				$sql = $sql."and ";
			}
			else
			{
				$has_condition = true;
			}

			$sql = $sql."(c.venue in (select v.id from venue as v where v.address in (select a.id from address as a where a.country in (".$country.")))) ";
		}

		$sql = $sql."limit ".($page*$limit).",".$limit;

		$result = DB::query(Database::SELECT, $sql)->execute();

		return $result;
	}

	public function get($id)
	{
		$conf = ORM::factory('Conference', $id);

		return $conf;
	}

	public function get_for_view($id)
	{
		$conf = $this->get($id);

		$model = array();

		$model['name'] = $conf->get('name');
		$model['start_date'] = $this->to_readable_date($conf->get('start_date'));
		$model['end_date'] = $this->to_readable_date($conf->get('end_date'));
		$model['description'] = $conf->get('description');
		$model['website'] = $conf->get('website');
		$model['deadline'] = $this->to_readable_date($conf->get('deadline'));
		$model['contact_person'] = $conf->get('contact_person');
		$model['contact_email'] = $conf->get('contact_email');
		$model['accept_notify'] = $this->to_readable_date($conf->get('accept_notify'));

		$regis = $this->get_registration_period($id);

		$model['regis_start'] = $this->to_readable_date($regis->get('start_date'));
		$model['regis_end'] = $this->to_readable_date($regis->get('end_date'));

		$orgainzation = $this->get_organization($conf->get('organizer'));
		$model['organizer'] = $orgainzation->get('name');

		$type = $this->get_type($conf->get('type'));
		$model['type'] = $type->get('name');

		$model['category'] = $this->get_categories($id);

		$venue = $this->get_venue($conf->get('venue'));
		$model['venue'] = $venue;

		return $model;
	}

	public function get_registration_period($conf_id)
	{
		$period = ORM::factory('Registration')
					->where('conference_id', '=', $conf_id)
					->find();

		return $period;
	}

	protected function get_venue($id)
	{
		$venue = ORM::factory('Venue', $id);

		$model = array();

		$model['name'] = $venue->get('name');

		$address = ORM::factory('Address', $venue->get('address'));

		$model['address'] = $address->get('address');
		$model['city'] = $address->get('city');
		$model['state'] = $address->get('state');
		$model['postal_code'] = $address->get('postal_code');
		$model['country'] = $this->get_country_name($address->get('country'));

		return $model;
	}

	protected function get_country_name($id)
	{
		$country = ORM::factory('Country', $id);
		return $country->get('name');
	}

	protected function get_organization($id)
	{
		$orgainzation = ORM::factory('Organization', $id);
		return $orgainzation;
	}

	protected function get_type($id)
	{
		$type = ORM::factory('ConferenceType', $id);
		return $type;
	}

	protected function get_category_name($id)
	{
		$category = ORM::factory('ConferenceCategory', $id);
		return $category->get('name');
	}

	protected function get_categories($conf_id)
	{
		$cat_confs = ORM::factory('CategoryConference')
						->where('conference', '=', $conf_id)
						->find_all();

		$cat_array = array();

		foreach ($cat_confs as $cat_conf) {
			array_push($cat_array, $this->get_category_name($cat_conf->get('category')));
		}

		return $cat_array;
	}

	public function create($conference)
	{

		$address = ORM::factory('Address')
					->values(
						$conference,
						array(
							'address',
							'city',
							'state',
							'postal_code',
							'country'))
					->create();

		$address_id = $address->pk();

		$venue = ORM::factory('Venue');
		$venue->name = $conference['venue_name'];
		$venue->address = $address_id;
		$venue->save();

		$venue_id = $venue->pk();

		$conference['venue'] = $venue_id;

		$organizer = ORM::factory('Organization');
		$organizer->name = $conference['organizer'];
		$organizer->save();

		$org_id = $organizer->pk();
		$conference['organizer'] = $org_id;

		$conference['start_date'] = $this->convert_date($conference['start_date']);
		$conference['end_date'] = $this->convert_date($conference['end_date']);
		$conference['deadline'] = $this->convert_date($conference['deadline']);
		$conference['accept_notify'] = $this->convert_date($conference['accept_notify']);

		$conf = ORM::factory('Conference')
				->values(
					$conference, 
					array(
						'name',
						'start_date',
						'end_date',
						'description',
						'organizer',
						'website',
						'type',
						'deadline',
						'contact_person',
						'contact_email',
						'accept_notify',
						'venue'))
				->create();

		$conf_id = $conf->pk();

		$regis = ORM::factory('Registration');
		$regis->start_date = $this->convert_date($conference['regis_start']);
		$regis->end_date = $this->convert_date($conference['regis_end']);
		$regis->conference_id = $conf_id;
		$regis->save();

		$categories = $conference['category'];

		foreach ($categories as $category) 
		{
			$cat_conf = ORM::factory('CategoryConference');
			$cat_conf->conference = $conf_id;
			$cat_conf->category = $category;
			$cat_conf->save();
		}

		return $conf_id;
	}

	public function update($conference)
	{
		$conf = ORM::factory('Conference');

		//TODO: set data

		$conf->save();
	}

	public function delete($conference)
	{
		$conf = ORM::factory('Conference');

		//TODO: set data

		$conf->delete();
	}

	protected function convert_date($input)
	{
		$date = date_parse_from_format("d/m/Y", $input);
		return $date['year']."-".$date['month']."-".$date['day'];
	}

	protected function to_readable_date($input)
	{
		$date = date_parse($input);
		return date('j F Y', mktime(0, 0, 0, $date['month'], $date['day'], $date['year']));
	}

	//only for mockup
	private function populate()
	{
		$conferences = array(
							array("name" => "4th Global Conference: Performance: Visual Aspects of Performance Practice", "location" => "Oxford, United Kingdom", "type" => "Conference", "duration" => "17 - 19 Sep 2013"),
							array("name" => "The Best in Heritage 2013 ", "location" => "Dubrovnik, Croatia", "type" => "Seminar", "duration" => "17 - 19 Sep 2013"),
							array("name" => "2nd Global Conference: The Graphic Novel", "location" => "Oxford, United Kingdom", "type" => "Conference", "duration" => "17 - 19 Sep 2013"),
							array("name" => "Land Labour Capital", "location" => "Limerick, Ireland", "type" => "Workshop", "duration" => "17 - 19 Sep 2013"),
							array("name" => "Arts and Narrative", "location" => "Langley, Canada", "type" => "Webinar", "duration" => "17 - 19 Sep 2013"),
							array("name" => "4th Global Conference: Performance: Visual Aspects of Performance Practice", "location" => "Oxford, United Kingdom", "type" => "Conference", "duration" => "17 - 19 Sep 2013"),
							array("name" => "The Best in Heritage 2013 ", "location" => "Dubrovnik, Croatia", "type" => "Seminar", "duration" => "17 - 19 Sep 2013"),
							array("name" => "2nd Global Conference: The Graphic Novel", "location" => "Oxford, United Kingdom", "type" => "Conference", "duration" => "17 - 19 Sep 2013"),
							array("name" => "Land Labour Capital", "location" => "Limerick, Ireland", "type" => "Workshop", "duration" => "17 - 19 Sep 2013"),
							array("name" => "Arts and Narrative", "location" => "Langley, Canada", "type" => "Webinar", "duration" => "17 - 19 Sep 2013"),
						);

		return $conferences;
	}

	//only for mockup
	private function populate_by_country()
	{
		$conferences = array(
							array("name" => "4th Global Conference: Performance: Visual Aspects of Performance Practice", "location" => "Oxford, United Kingdom", "type" => "Conference", "duration" => "17 - 19 Sep 2013"),
							array("name" => "The Best in Heritage 2013 ", "location" => "Oxford, United Kingdom", "type" => "Seminar", "duration" => "17 - 19 Sep 2013"),
							array("name" => "2nd Global Conference: The Graphic Novel", "location" => "Oxford, United Kingdom", "type" => "Conference", "duration" => "17 - 19 Sep 2013"),
							array("name" => "Land Labour Capital", "location" => "Oxford, United Kingdom", "type" => "Workshop", "duration" => "17 - 19 Sep 2013"),
							array("name" => "Arts and Narrative", "location" => "Oxford, United Kingdom", "type" => "Webinar", "duration" => "17 - 19 Sep 2013"),
						);

		return $conferences;
	}
}