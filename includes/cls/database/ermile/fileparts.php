<?php
namespace database\ermile;
class fileparts 
{
	public $id              = array('null' =>'NO',  'show' =>'NO',  'label'=>'id',            'type' => 'int@10',                                                  );
	public $file_id         = array('null' =>'NO',  'show' =>'YES', 'label'=>'file',          'type' => 'int@10',                                                  'foreign'=>'files@id!id');
	public $filepart_part   = array('null' =>'NO',  'show' =>'YES', 'label'=>'part',          'type' => 'smallint@5',                                              );
	public $filepart_code   = array('null' =>'YES', 'show' =>'YES', 'label'=>'code',          'type' => 'varchar@64',                                              );
	public $filepart_status = array('null' =>'NO',  'show' =>'YES', 'label'=>'status',        'type' => 'enum@awaiting,start,inprogress,appended,failed,finished', );
	public $user_id         = array('null' =>'YES', 'show' =>'NO',  'label'=>'user',          'type' => 'smallint@5',                                              'foreign'=>'users@id!user_nickname');
	public $date_modified   = array('null' =>'YES', 'show' =>'NO',  'label'=>'modified',      'type' => 'timestamp@',                                              );


	//------------------------------------------------------------------ id
	public function id() {$this->validate()->id();}

	//------------------------------------------------------------------ id - foreign key
	public function file_id() 
	{
		$this->form("select")->name("file_")->min(0)->max(9999999999)->required()->type("select")->validate()->id();
		$this->setChild();
	}
	public function filepart_part() 
	{
		$this->form("text")->name("part")->min(0)->max(99999)->required()->type('number');
	}
	public function filepart_code() 
	{
		$this->form("text")->name("code")->maxlength(64)->type('text');
	}

	//------------------------------------------------------------------ select button
	public function filepart_status() 
	{
		$this->form("select")->name("status")->type("select")->required()->validate();
		$this->setChild();
	}

	//------------------------------------------------------------------ user_id
	public function user_id() {$this->validate()->id();}
	public function date_modified() {}
}
?>