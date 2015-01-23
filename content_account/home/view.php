<?php
namespace content_account\home;

class view extends \mvc\view
{
	public function config()
	{
		// $this->include->datatable   = false;
		// $this->include->jquery      = true;
		// $this->include->fontawesome = false;
		$this->include->telinput       = true;
		$this->include->customcss      = false;
		$this->include->customjs       = false;
		$this->data->bodyclass         = 'unselectable';
		
		$this->data->myform            = 'account';
		
		// form variable
		$this->data->post              = array();
		$this->data->post['referer']   = \lib\utility::get('referer');
		$this->data->post['from']      = \lib\utility::get('from');
		$this->data->post['mobile']    = \lib\utility::get('mobile');


		switch ($this->data->module)
		{
			case 'login':
				$this->data->page['desc']	= T_('Login');
				break;

			case 'signup':
				$this->data->page['desc']	= T_('Create an account');
				break;

			case 'verification':
				$this->data->page['desc']	= T_('Verificate');
				break;

			case 'verificationsms':
				$this->data->page['desc']	= T_('Verificate');
				break;

			case 'recovery':
				$this->data->page['desc']	= T_('Recovery');
				break;

			case 'changepass':
				$this->data->page['desc']	= T_('Change password');
				$this->include->telinput	= false;
				break;

			case 'smsdelivery':
				$this->data->page['desc']	= T_('SMS Delivery');
				$this->include->telinput	= false;
				break;

			case 'smscallback':
				$this->data->page['desc']	= T_('SMS Callback');
				$this->include->telinput	= false;
				break;

			default:
				$this->data->page['desc']	= T_('Ermile');
				break;
		}

		$this->global->title		= $this->data->page['desc'].' | '.$this->data->site['title'];
		$form = $this->createform('.'.$this->data->myform, $this->data->module);
	}
}
?>