<?php
class Reservas extends Controller{
	protected function Index(){
		$viewmodel = new ReservaModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function add(){
		$viewmodel = new ReservaModel();
		$this->returnView($viewmodel->add(), true);
	}
}