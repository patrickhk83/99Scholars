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

	private $_current_page;
	private $_per_page = 10;
	public $_nSubTotal;
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
		return $this->list_by(null, null, null, null, null, null, null , $user_id);
	}

	public function list_by($category, 
							$accept_abstract, 
							$start_date, 
							$end_date, 
							$type, 
							$country, 
							$search_text , 
							$user_id = NULL, 
							$page = 1, 
							$limit = 20)
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

			$condition = $condition."('".$this->convert_date($start_date)."' <= c.start_date) ";
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

			$condition = $condition."('".$this->convert_date($end_date)."' >= c.end_date) ";
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
			$count_sql = $sql.$condition;
			$count_result = $this->count_all_conference(
										DB::query(Database::SELECT, $count_sql)
										->execute()->as_array() , $search_text);
			$result['total'] = $count_result;
			
		}

		$sql = $sql.$condition." order by c.start_date desc ";

		$start_page = $page - 1;
		//$sql = $sql;//."limit ".($start_page*$limit).",".$limit;
		//
		$this->_current_page = $start_page;
			$result['conferences'] = $this->convert_for_listing(
									DB::query(Database::SELECT, $sql)
									->execute()->as_array() , $search_text);
		return $result;
	}
//2014-1-28 Created by David Ming Start

	private function count_all_conference($results , $search_text)
	{
		$nTotal = 0;
		
		foreach ($results as $result) 
		{
			$bSearch = $this->validate_search_text($result['id'] , $search_text);

			if($bSearch === FALSE)
				continue;
			else $nTotal ++;

		}
		return $nTotal;
	}

	private function validate_search_text($conf_id , $search_text)
	{
		if($search_text == "1234567890qwertyuiopasdfghjklzxcvbnm") return TRUE;

		$search_text_array = array();
		$search_text_array = explode(' ', $search_text);

		$nCount = 0;
		$query = "SELECT COUNT(*) AS nCount FROM conference WHERE id='".$conf_id."' ";
		$query .= "AND (name LIKE '%".$search_text."%' OR ";
		$query .= "description LIKE '%".$search_text."%' OR ";
		$query .= "website LIKE '%".$search_text."%' OR ";	
		$query .= "contact_person LIKE '%".$search_text."%' OR ";
		$query .= "contact_email LIKE '%".$search_text."%' OR ";
		$query .= "contact_phone LIKE '%".$search_text."%')";
		
		$result = DB::query(Database::SELECT, $query)->execute();
		$nCount = $result->get('nCount');
		if($nCount > 0) return TRUE;

		$query = "SELECT COUNT(*) AS nCount FROM conference, venue WHERE ";
		$query .= "conference.id='".$conf_id."' AND venue.id=conference.venue ";
		$query .= "AND venue.name LIKE '%".$search_text."%'";
		$result = DB::query(Database::SELECT, $query)->execute();
		$nCount = $result->get('nCount');
		if($nCount > 0) return TRUE;

		$query = "SELECT COUNT(*) AS nCount FROM conference, venue, address WHERE ";
		$query .= "conference.id='".$conf_id."' AND venue.id=conference.venue AND address.id=venue.address ";
		$query .= "AND (address.address LIKE '%".$search_text."%' OR ";
		$query .= "address.city LIKE '%".$search_text."%' OR ";
		$query .= "address.state LIKE '%".$search_text."%' OR ";
		$query .= "address.postal_code LIKE '%".$search_text."%')";
		$result = DB::query(Database::SELECT, $query)->execute();
		$nCount = $result->get('nCount');
		if($nCount > 0) return TRUE;

		$query = "SELECT COUNT(*) AS nCount FROM conference WHERE id='".$conf_id."' ";
		$query .= "AND (";
		$nCount1 = 0;
			
		foreach($search_text_array as $element)
		{
			if($nCount1 > 0)
				$query .= "AND ";
			$query .= "(name LIKE '%".$element."%' OR ";
			$query .= "description LIKE '%".$element."%' OR ";
			$query .= "website LIKE '%".$element."%' OR ";
			$query .= "contact_person LIKE '%".$element."%' OR ";
			$query .= "contact_email LIKE '%".$element."%' OR ";
			$query .= "contact_phone LIKE '%".$element."%') ";
			$nCount1 ++;

		}	

		$query .= ")";
		$result = DB::query(Database::SELECT, $query)->execute();
		$nCount = $result->get('nCount');
		if($nCount > 0) return TRUE;

		$query = "SELECT COUNT(*) AS nCount FROM conference, venue WHERE ";
		$query .= "conference.id='".$conf_id."' AND venue.id=conference.venue ";
		$query .= "AND (";
		$nCount1 = 0;	
		foreach($search_text_array as $element)
		{
			if($nCount1 > 0)
				$query .= "OR ";
			$query .= "venue.name LIKE '%".$element."%' ";
			$nCount1 ++;
		}
		$query .= ")";
		$result = DB::query(Database::SELECT, $query)->execute();
		$nCount = $result->get('nCount');
		if($nCount > 0) return TRUE;

		$query = "SELECT COUNT(*) AS nCount FROM conference, venue, address WHERE ";
		$query .= "conference.id='".$conf_id."' AND venue.id=conference.venue AND address.id=venue.address ";
		$query .= "AND (";

		$nCount1 = 0;
		foreach($search_text_array as $element)
		{
			if($nCount1 > 0)
				$query .= "AND ";
			$query .= "(address.address LIKE '%".$element."%' OR ";
			$query .= "address.city LIKE '%".$element."%' OR ";
			$query .= "address.state LIKE '%".$element."%' OR ";
			$query .= "address.postal_code LIKE '%".$element."%') ";
			$nCount1 ++;
		}	
		$query .= ")";
		$result = DB::query(Database::SELECT, $query)->execute();
		$nCount = $result->get('nCount');
		if($nCount > 0) return TRUE;

		$query = "SELECT COUNT(*) AS nCount FROM conference AS c, venue AS v, address AS a ";
		$query .= "WHERE c.id='".$conf_id."' AND v.id=c.venue AND a.id=v.address AND ";

		$nCount1 = 0;	
		foreach($search_text_array as $element)
		{
			if($nCount1 > 0) $query .= "AND ";
			$query .= "CONCAT(IFNULL(c.name, ''), IFNULL(c.description, ''),
			IFNULL(c.website, ''), IFNULL(c.contact_person, ''), IFNULL(c.contact_email, ''),
			IFNULL(c.contact_phone, ''), IFNULL(v.name, ''), IFNULL(a.address, ''),
			IFNULL(a.city, ''), IFNULL(a.state, ''), IFNULL(a.postal_code, '')) LIKE '%".$element."%' ";
			$nCount1 ++;
		}

		$result = DB::query(Database::SELECT, $query)->execute();
		$nCount = $result->get('nCount');
		if($nCount > 0) return TRUE;
		
//echo Debug::vars($query);		
		return FALSE;
	}


	protected function convert_for_listing($results , $search_text)
	{
		$conferences = array();
		$start_segment = $this->_current_page * $this->_per_page;
		$end_segment = ($this->_current_page + 1) * $this->_per_page;
		$nCount = 0;
		foreach ($results as $result) 
		{
			$conference = array();
			
			$bSearch = $this->validate_search_text($result['id'] , $search_text);

			if($bSearch === FALSE) 
			{
				continue;
			}
			else
			{
				if($nCount < $start_segment)
				{
					$nCount ++;
					continue;
				}

				if($nCount > $end_segment)
					break;
				$conference['id'] = $result['id'];
				$conference['name'] = $result['name'];
				$conference['duration'] = $this->render_duration($result['start_date'], $result['end_date']);
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

			$nCount ++;
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
		$model['country'] = Model_Constants_Address::$countries[$address->get('country')];

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
		
		$this->_init_orm();
		$new_conference_id = $this->_create_new_conference($data);
		return $new_conference_id;
		
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

			if(isset($data['selectedTag']))
			{
				foreach($data['selectedTag'] as $selectedTag)
				{
					$tag_conference = ORM::factory('ConferenceTag');
					$selectedTag['conference_id'] = $confernce_id;
					$tag_conference->values($selectedTag)->create();
				}
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

	protected function render_duration($start, $end)
	{
		$duration = $this->to_readable_date($start);

		if(isset($end))
		{
			$duration .= " - ".$this->to_readable_date($end);
		}

		return $duration;
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

	public function get_suggest_tag_list($term)
	{
		$tag_orm = ORM::factory('Tag');
		$tag_orm->where('tag_name' , 'LIKE' , '%'.$term.'%');
		$limit = 20;
		$offset = 0;
		return $tag_orm->find_all($limit , $offset);			
	}

	public function set_new_tag($term)
	{
		$tag_orm = ORM::factory('Tag')->where('tag_name' , '=' , $term)->find();
		if(is_null($tag_orm->tag_name) || $tag_orm->tag_name == '')
		{
			$new_tag_orm = ORM::factory('Tag');
			$new_tag_orm->tag_name = $term;
			$new_tag_orm->save();
			return $new_tag_orm->id;			
		}
		else
			return $tag_orm->id;
	}

	public function get_conference_tag($conference_id)
	{
		$query = "SELECT tags.tag_name as tag_name FROM tags, conference_tag WHERE conference_tag.conference_id='".$conference_id."' AND conference_tag.tag_id=tags.id";
		$result = DB::query(Database::SELECT , $query)->execute();
		return $result;
	}

	public function get_suggest_seminar_list($term)
	{
		$search_text_array = array();
		$search_text_array = explode(' ', $term);

		$query = "SELECT c.id AS seminar_id, c.name AS seminar_name FROM conference AS c, venue AS v, address AS a ";

		$query .= "WHERE c.type='2' AND v.id=c.venue AND a.id=v.address AND ";

		$nCount = 0;
		foreach($search_text_array as $element)
		{
//			if($element == '' || $element == NULL) 
//				continue;
			if($nCount > 0) $query .= " AND ";
			$query .= "CONCAT(IFNULL(c.name, ''), IFNULL(c.description, ''),
				IFNULL(c.website, ''), IFNULL(c.contact_person, ''), IFNULL(c.contact_email, ''),
				IFNULL(c.contact_phone, ''), IFNULL(v.name, ''), IFNULL(a.address, ''),
				IFNULL(a.city, ''), IFNULL(a.state, ''), IFNULL(a.postal_code, '')) LIKE '%".$element."%'";
			$nCount ++;
		}
		$query .= " LIMIT 0, 20";
		$result = DB::query(Database::SELECT, $query)->execute();
		return $result;
		
	}
}