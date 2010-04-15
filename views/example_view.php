<html>
<head>
<title>Welcome to Message Library Example</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

#error_msg {
 background:#FBE6F2 none repeat scroll 0 0;
 border:1px solid #D893A1;
}
#notice_msg {
 background:#EFF8D9 none repeat scroll 0 0;
 border:1px solid #B4E04B;
}
#error_msg, #notice_msg {
 color:#333333;
 padding: 10px;
 min-height: 48px;
 overflow: auto; /* need to clear float */
 margin-bottom:15px;
}


#error_msg p, #notice_msg p {
 font-size: 1.4em;
 margin-bottom:5px;
}

#error_msg img, #notice_msg img {
 float:left;
}

#error_msg_container, #notice_msg_container {
 float:left;
 margin-left:10px;
}

.message {
 color: red;
}
</style>
</head>
<body>

<h1>Message Library Example Page</h1>

<?php echo $this->message->display(); ?>

<p>Click <a href="<?php echo site_url('example/message')?>">here</a> to show a simple red message without redirect and with basic styling added to it from the config:</p>
<code>$this->message->set('message','this is just a message');</code>

<p>Click <a href="<?php echo site_url('example/notice')?>">here</a> to show a simple red message and a notice styled by a view (in application/views/messages/notice_view.php) without redirect using an array:</p>
<code>		$data = array(<br />
			&nbsp;&nbsp;'message'=>'this is just a message',<br />
			&nbsp;&nbsp;'notice'=>'this is just a notice'<br />
					);<br />
					<br />
		$this->message->set($data);</code>

<p>Click <a href="<?php echo site_url('example/error')?>">here</a> to show a simple red message and an error styled by a view (in application/views/messages/error_view.php) with redirect:</p>
<code>
$this->message->set('message','this is just a message');<br />
$this->message->set('error','this is an error');
</code>

<h1>Basic Functions</h1>
<p>Set a message</p>
<code>$this->message->set('notice','this is just a notice');</code>

<p>Set an array of messages</p>
<code>		$data = array(<br />
			&nbsp;&nbsp;'message'=>'this is just a message',<br />
			&nbsp;&nbsp;'notice'=>'this is just a notice'<br />
					);<br />
					<br />
		$this->message->set($data);</code>

<p>Return all messages</p>
<code>
$messages = $this->message->get();
</code>

<p>Return a group of messages</p>
<code>
$messages = $this->message->get('notice');
</code>

<p>Show all messages</p>
<code>
echo $this->message->display();
</code>

<p>Show a group of messages</p>
<code>
echo $this->message->display('notice');
</code>
</body>
</html>
