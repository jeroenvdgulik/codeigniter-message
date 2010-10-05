<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Message Class
 *
 * a library for giving feedback to the user
 * based on darkhouse's message library
 * ref: http://codeigniter.com/wiki/Message/
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Message
 * @author		Jeroen v.d Gulik
 * @version		1.2
 */

class CI_Message {

	private $CI;
	private $messages		= array();
	private $message_prefix	= '';
	private $message_suffix	= '';
	private $message_folder	= '';
	private $message_view	= '';
	private $wrapper_prefix	= '';
	private $wrapper_suffix	= '';

	/**
	 * Message Constructor
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function CI_Message($config = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');

		if ($this->CI->session->userdata('_messages'))
		{
			$this->messages = $this->CI->session->userdata('_messages');
		}

		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		log_message('debug', "Message Class Initialized");
	}

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}

	/**
	 * Add data to the "message" array
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	function set($newdata = array(), $newvalue = NULL)
	{
		if (is_string($newdata))
		{
			$newdata = array($newdata => $newvalue);
		}

		if (count($newdata) > 0)
		{
			foreach ($newdata as $group => $value)
			{
				// Let's skip empty messages
				if (empty($value)) continue;
				
				$this->messages[$group][] = $value;
			}

			$this->CI->session->set_userdata('_messages', $this->messages);
		}
	}

	/**
	 * Fetches all or a group of "messages"
	 *
	 * @access	public
	 * @param	string	the group you want to fetch
	 * @return	mixed
	 */
	function get($group = FALSE)
	{
		// do we have something to show?
		if (count($this->messages) == 0) return FALSE;

		// was a group set? else we return everything
		if ($group)
		{
			// does the group exist?
			return (isset($this->messages[$group])) ? $this->messages[$group] : FALSE;
		}
		else
		{
			return $this->messages;
		}
	}

	/**
	 * Outputs all or a group of "messages"
	 *
	 * @access	public
	 * @param	string	the group you want to output
	 * @return	string
	 */
	function display($group = FALSE)
	{
		// do we have something to show?
		if (($messages = $this->get($group)) === FALSE) return FALSE;

		// let's format the data
		$output = $this->format_output($group);

		// clear our message cache
		$this->CI->session->unset_userdata('_messages');

		return $output;
	}

	/**
	 * Formats the output
	 *
	 * @access	private
	 * @param	string	the group you want to format
	 * @return	string
	 */
	private function format_output($by_group = FALSE)
	{
		$output = NULL;

		// loop through the groups and cascade through format options
		foreach ($this->messages as $group => $messages)
		{
			// was a group set? if so skip all groups that do not match
			if ($by_group !== FALSE && $group != $by_group) continue;

			// does a view partial exist?
			if (file_exists(APPPATH.'views/'.$this->message_folder.$group.'_view'.EXT))
			{
				$output .= $this->CI->load->view($this->message_folder.$group.'_view', array('messages'=>$messages), TRUE);
			}
			// does a default view partial exist?
			elseif (file_exists(APPPATH.'views/'.$this->message_folder.$this->message_view.'_view'.EXT))
			{
				$output .= $this->CI->load->view($this->message_folder.$this->message_view.'_view', array('messages'=>$messages), TRUE);
			}
			// fallback to default values (possibly set by config)
			else
			{
				$output .= $this->wrapper_prefix . PHP_EOL;

				foreach ($messages as $msg)
				{
					$output .= $this->message_prefix . $msg . $this->message_suffix . PHP_EOL;
				}

				$output .= $this->wrapper_suffix . PHP_EOL;
			}
		}

		return $output;
	}
}

/* End of file Message.php */
/* Location: ./application/libraries/Message.php */
