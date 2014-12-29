<?php
namespace mvc;

class view extends \lib\view
{
	function _construct()
	{
		// define default value for global
		// var_dump(T_("Ermile"));
		// var_dump(T_(1));
		$this->global->site_title		= T_("Ermile");
		$this->global->site_desc		= T_("Ermile is new");
		$this->global->site_slogan		= T_("Ermile is our company");
		$this->global->login			= false;

		// define default value for include
		$this->include->datatable		= false;
		$this->include->jquery			= true;
		$this->include->fontawesome		= false;
		$this->include->telinput		= false;
		$this->include->customcss		= true;
		$this->include->customjs		= true;

		$this->data->layout_account		= "content_account/home/display.html";
		// var_dump($this->global->site_slogan);

		if (!locale_emulation()) {
			$this->include->gettext 	= 'Translation use native gettext dll';
		}
		else {
			$this->include->gettext 	= 'Translation use PHP gettext class';
		}
	}
}
?>