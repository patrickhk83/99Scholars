<?php defined('SYSPATH') or die('No direct script access.');

class Model_Seminar extends ORM {

	protected $_table_name = 'seminar';
	public function rules()
	{
		return array(
			'speaker' => array(
				array('not_empty')
        	),
    	);
	}
	public function filters()
	{
		return array(
			'speaker' => array(
	            array('trim'),
	        ),
	        'speaker' => array(
	            array('abstract'),
	        ),
	    );
	}

	public function get_time_duration()
	{
		$duration = date("h:i A", $this->start_time);

		if($this->end_time > 0)
		{
			$duration .= " - ".date("h:i A", $this->end_time);
		}

		return $duration;
	}
}