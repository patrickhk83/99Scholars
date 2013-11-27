<?php defined('SYSPATH') or die('No direct script access.');

class Service_Conference {

	/**
	 * @var   Kohana_Cache instances
	 */
	protected static $instance = array();

	Protected $_conference;
	Protected $_venue;
	Protected $_organizer;
	Protected $_address;		
	Protected $_registration;
	Protected $_seminar;

	 /**
	 * get Service_Conference by singleton
     * @return Service_Conference
     */
    public static function instance()
    {
        if ( ! (self::$instance instanceof Service_Conference))
        {
            self::$instance = new Service_Conference;
        }
        return self::$instance;
    }

	public function list_all($user_id = NULL)
	{
		return $this->list_by(null, null, null, null, null, null, $user_id);
	}

	public function list_by($category, $accept_abstract, $start_date, $end_date, $type, $country, $user_id = NULL, $page = 1, $limit = 20)
	{
		$has_condition = false;

		$attendee_field = '';
		$attendee_join = '';

		if(isset($user_id) && $user_id !== NULL)
		{
			$attendee_field = ", d.id as booked ";
			$attendee_join = "LEFT OUTER JOIN attendee d ON c.id = d.conference and d.user = ".$user_id." ";
		}

		$sql = "select c.id, c.name, c.start_date, c.end_date, c.type, c.venue".$attendee_field." from conference as c ".$attendee_join;
		$count_sql = "select count(*) as total from conference as c ";
		$condition = "";

		$result = array();

		//check if there is any criteria
		if($this->has_value($category) || ((isset($accept_abstract) && $accept_abstract == 'true')) || $this->has_value($start_date) || $this->has_value($end_date) || $this->has_value($type) || $this->has_value($country))
		{
			$sql = $sql."where ";
			$count_sql = $count_sql."where ";
		}

		if($this->has_value($category))
		{
			$condition = $condition."(c.id in (select conference from category_conference where category in (".$category."))) ";
			$has_condition = true;
		}

		if(isset($accept_abstract) && $accept_abstract == 'true')
		{
			if($has_condition)
			{
				$condition = $condition."and ";
			}
			else
			{
				$has_condition = true;
			}

			$condition = $condition."(curdate() < c.deadline) ";
		}

		if($this->has_value($start_date))
		{
			if($has_condition)
			{
				$condition = $condition."and ";
			}
			else
			{
				$has_condition = true;
			}

			$condition = $condition."('".$this->convert_date($start_date)."' >= c.start_date) ";
		}

		if($this->has_value($end_date))
		{
			if($has_condition)
			{
				$condition = $condition."and ";
			}
			else
			{
				$has_condition = true;
			}

			$condition = $condition."('".$this->convert_date($end_date)."' <= c.end_date) ";
		}

		if($this->has_value($type))
		{
			if($has_condition)
			{
				$condition = $condition."and ";
			}
			else
			{
				$has_condition = true;
			}

			$condition = $condition."(c.type in (".$type.")) ";
		}

		if($this->has_value($country))
		{
			if($has_condition)
			{
				$condition = $condition."and ";
			}
			else
			{
				$has_condition = true;
			}

			$condition = $condition."(c.venue in (select v.id from venue as v where v.address in (select a.id from address as a where a.country in (".$country.")))) ";
		}

		if($page == 1)
		{
			$count_sql = $count_sql.$condition;

			$count_result = DB::query(Database::SELECT, $count_sql)->execute();

			$result['total'] = $count_result->get('total');
		}

		$start_page = $page - 1;
		$sql = $sql.$condition."limit ".($start_page*$limit).",".$limit;
		
		$result['conferences'] = $this->convert_for_listing(
									DB::query(Database::SELECT, $sql)
									->execute()->as_array());

		return $result;
	}

	protected function convert_for_listing($results)
	{
		$conferences = array();

		foreach ($results as $result) 
		{
			$conference = array();

			$conference['id'] = $result['id'];
			$conference['name'] = $result['name'];
			$conference['duration'] = $this->to_readable_date($result['start_date'])." - ".$this->to_readable_date($result['end_date']);
			$conference['type'] = $this->get_type($result['type'])->get('name');
			$conference['type_style'] = $this->get_type_style($conference['type']);
			$conference['location'] = $this->get_venue_short_location($result['venue']);

			if(isset($result['booked']))
			{
				$conference['is_booked'] = TRUE;
			}
			else
			{
				$conference['is_booked'] = FALSE;
			}

			array_push($conferences, $conference);
		}

		return $conferences;
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

		//TODO: get short address without calling DB
		$model['location'] = $this->get_venue_short_location($conf->get('venue'));

		return $model;
	}

	public function get_registration_period($conf_id)
	{
		$period = ORM::factory('Registration')
					->where('conference_id', '=', $conf_id)
					->find();

		return $period;
	}

	protected function get_venue_short_location($venue_id)
	{
		$venue = $this->get_venue($venue_id);

		$location;

		if(isset($venue['state']) && trim($venue['state']) !== '')
		{
			$location = $venue['state'];
		}
		else
		{
			$location = $venue['city'];
		}

		return $location.", ".$venue['country'];
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

	public function create($data)
	{

		Log::instance()->add(Log::INFO, '_create_conference data: :data', array(
    		':data' => print_r($data, true),
		));

		$this->_convert_date($data);
		$this->_init_orm();
		$new_conference_id = $this->_create_new_conference($data);
		return $new_conference_id;
		
	}
	Protected function _convert_date($data)
	{
		$data['Conference']['start_date'] = DateTime::createFromFormat('d/m/Y', $data['Conference']['start_date'])->format('Y-m-d');

		if($data['Conference']['type'] == 1)
		{
			$data['Conference']['end_date'] = DateTime::createFromFormat('d/m/Y', $data['Conference']['end_date'])->format('Y-m-d');
			$data['Conference']['deadline'] = DateTime::createFromFormat('d/m/Y', $data['Conference']['deadline'])->format('Y-m-d');
			$data['Registration']['start_date'] = DateTime::createFromFormat('d/m/Y', $data['Registration']['start_date'])->format('Y-m-d');
			$data['Registration']['end_date'] = DateTime::createFromFormat('d/m/Y', $data['Registration']['end_date'])->format('Y-m-d');
			$data['Conference']['accept_notify'] = DateTime::createFromFormat('d/m/Y', $data['Conference']['accept_notify'])->format('Y-m-d');
		}

		return $data;
	}
	Protected function _init_orm()
	{
		$this->_conference = ORM::factory('Conference');
		$this->_venue = ORM::factory('Venue');
		$this->_organizer = ORM::factory('Organization');
		$this->_address = ORM::factory('Address');		
		$this->_registration = ORM::factory('Registration');
		$this->_seminar = ORM::factory('Seminar');
	}
	Protected function _create_new_conference($data)
	{
		$db = Database::instance();
		$db->begin();

		try
		{
			//create
			Log::instance()->add(Log::INFO, 'address data create: :message', array('message', print_r($data['Address'], true)));
			$address = $this->_address->values($data['Address'])->create();
			$data['Venue']['address'] = $this->_address->pk();
			$this->_venue->values($data['Venue'])->save();

			Log::instance()->add(Log::INFO, 'Organization data save: :message', array('message', print_r($data['Organization'], true)));
			$this->_organizer->values($data['Organization'])->save();

			$data['Conference']['venue'] = $this->_venue->pk();
			$data['Conference']['organizer'] = $this->_organizer->pk();
			Log::instance()->add(Log::INFO, 'Conference data save: :message', array('message', print_r($data['Conference'], true)));
			$conf = $this->_conference->values($data['Conference'])->create();

			$confernce_id = $conf->pk();

			if($data['Conference']['type'] == 1)
			{
				$data['Registration']['conference_id'] = $confernce_id;
				Log::instance()->add(Log::INFO, 'Registration data save: :message', array('message', print_r($data['Registration'], true)));
				$this->_registration->values($data['Registration'])->save();
			}

			foreach ($data['Category'] as $category) 
			{
				$category_conference = ORM::factory('CategoryConference');
				$category['conference'] = $confernce_id;
				Log::instance()->add(Log::INFO, 'Category data create: :message', array('message', print_r($data['Category'], true)));
				$category_conference->values($category)->create();
			}

			if($data['Conference']['type'] == 2)
			{
				Log::instance()->add(Log::INFO, 'Seminar data save: :message', array('message', print_r($data['Seminar'], true)));
				$this->_seminar->values($data['Seminar'])->save();
			}
			$db->commit();
		}
		catch (ORM_Validation_Exception $e)
		{
			Log::instance()->add(Log::ERROR, 'orm validation exception: :message', array('message', $e->errors('models')));
			$db->rollback();
			throw $e;
		}

		return $confernce_id;
	}

	public function get_attendee($conf_id)
	{
		$attend_dao = new Dao_Attendee();
		$results = $attend_dao->get_attendee_list($conf_id);

		$user_service = new Service_User();

		$attendees = array();

		foreach ($results as $result) 
		{
			$attendee = array();

			$user = $user_service->get_by_id($result->get('user'));

			$attendee['id'] = $user['id'];
			$attendee['name'] = $user['first_name'].' '.$user['last_name'];
			//TODO: get user's affiliation

			array_push($attendees, $attendee);
		}

		return $attendees;
	}

	public function get_conference_user_attend($user_id)
	{
		$sql = 'select * from conference as c where c.id in (select conference from attendee as a where a.user = '.$user_id.')';

		$results = $this->convert_for_listing(
						DB::query(Database::SELECT, $sql)
						->execute()->as_array());

		return $results;
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

	private function has_value($param)
	{
		return isset($param) && !empty($param);
	}

	private function get_type_style($type_name)
	{
		switch($type_name) 
		{
			case 'Conference' : 
				return 'primary';
			case 'Seminar' :
				return 'success';
			case 'Workshop' :
				return 'warning';
			case 'Webinar' :
				return 'danger';
			case 'Online Conference' :
				return 'default';
		}

		return 'default';
	}
}