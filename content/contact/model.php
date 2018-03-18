<?php
namespace content\contact;


class model extends \mvc\model
{

	// log callers
	// user:send:contact
	// user:send:contact:fail
	// user:send:contact:empty:message
	// user:send:contact:empty:mobile
	// user:send:contact:wrong:captha
	// user:send:contact:register:by:mobile

	/**
	 * save contact form
	 */
	public function post_contact()
	{
		// check login
		if($this->login())
		{
			$user_id = $this->login("id");

			// get mobile from user login session
			$mobile = $this->login('mobile');

			if(!$mobile)
			{
				$mobile = \lib\request::post('mobile');
			}

			// get display name from user login session
			$displayname = $this->login("displayname");
			// user not set users display name, we get display name from contact form
			if(!$displayname)
			{
				$displayname = \lib\request::post("name");
			}
			// get email from user login session
			$email = \lib\db\users::get_email($user_id);
			// user not set users email, we get email from contact form
			if(!$email)
			{
				$email = \lib\request::post("email");
			}
		}
		else
		{
			// users not registered
			$user_id     = null;
			$displayname = \lib\request::post("name");
			$email       = \lib\request::post("email");
			$mobile      = \lib\request::post("mobile");
		}
		// get the content
		$content = \lib\request::post("content");

		// save log meta
		$log_meta =
		[
			'meta' =>
			[
				'login'    => $this->login('all'),
				'language' => \lib\language::get_language(),
				'post'     => \lib\request::post(),
			]
		];

		// /**
		//  * register user if set mobile and not register
		//  */
		// if($mobile && !$this->login())
		// {
		// 	// check valid mobile
		// 	if(\lib\utility\filter::mobile($mobile))
		// 	{
		// 		// check existing mobile
		// 		$exists_user = \lib\db\users::get_by_mobile($mobile);
		// 		// register if the mobile is valid
		// 		if(!$exists_user || empty($exists_user))
		// 		{
		// 			// signup user by site_guest
		// 			$user_id = \lib\db\users::signup(['mobile' => $mobile ,'type' => 'inspection', 'port' => 'site_guest']);
		// 			// save log by caller 'user:send:contact:register:by:mobile'
		// 			\lib\db\logs::set('user:send:contact:register:by:mobile', $user_id, $log_meta);
		// 		}
		// 	}
		// }

		// check content
		if($content == '')
		{
			\lib\db\logs::set('user:send:contact:empty:message', $user_id, $log_meta);
			\lib\debug::error(T_("Please try type something!"), "content");
			return false;
		}
		// ready to insert comments
		$args =
		[
			'author'  => $displayname,
			'email'   => $email,
			'type'    => 'comment',
			'content' => $content,
			'user_id' => $user_id
		];


		$url    = root. 'content/contact/allCommentJson';
		// if(!\lib\utility\file::exists($url))
		// {
		// 	\lib\utility\file::makeDir($url, null, true);
		// }
		// $url .= 'total_userteam.txt';
		if(!\lib\utility\file::exists($url))
		{
			\lib\utility\file::write($url, json_encode($args, JSON_UNESCAPED_UNICODE). "\n");
		}

		else
		{
			\lib\utility\file::append($url, json_encode($args, JSON_UNESCAPED_UNICODE). "\n");

		}

		// \lib\db\logs::set('user:send:contact', $user_id, $log_meta);
		\lib\debug::true(T_("Thank You For contacting us"));

	}
}