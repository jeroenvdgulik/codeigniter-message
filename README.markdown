CodeIgniter-Message
================

CodeIgniter-Message is a small codeigniter library for giving feedback to the user 

Configuration
-------------

what you would like to wrap your individual messages with

	$config['message_prefix'] = '<p>';
	$config['message_suffix'] = '</p>';

`
// what you would like the container to be of your messages
$config['wrapper_prefix'] = '<div class="message">';
$config['wrapper_suffix'] = '</div>';

// the folder to search for partial views
$config['message_folder'] = 'messages/';

// the default view to format messages
$config['message_view'] = 'message_view';
`

Basic Functions
-----

Set a message

` 
$this->message->set('notice','this is just a notice'); 
` 

Set an array of messages

`
$data = array(

  'message'=>'this is just a message',
  
  'notice'=>'this is just a notice'
  
);

$this->message->set($data);
`

Return all messages

`
$messages = $this->message->get();
`

Return a group of messages

`
$messages = $this->message->get('notice');
`

Show all messages

`
echo $this->message->display();
`

Show a group of messages

`
echo $this->message->display('notice');
`

Automagic functions
-----
If you have a message_folder defined in the config, any message key that matches a view will be autoloaded:

`
$this->message->set('notice','this is just a notice');
`

will autoload the file views/message_folder_name/notice_view.php
The basic layout for any view looks like this:

`
foreach ($messages as $message):

  echo $message;
  
endforeach;
`
		
This gives you freedom to style any message any way you want from within a view.

Extra
-----

If you'd like to request changes, report bug fixes, or contact
the developer of this library, email <email.n0xie@gmail.com>

