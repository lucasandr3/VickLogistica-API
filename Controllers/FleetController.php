<?php
namespace Controllers;

use \Core\Controller;
use \Models\Fleet;

class FleetController extends Controller {

    public function index()
    {
        $f = new Fleet();
        $fleet = $f->all();
        $this->returnJson($fleet);
    }

    public function reboques()
    {
        $f = new Fleet();
        $reboques = $f->allReboques();
        $this->returnJson($reboques);
    }

    public function semi_reboques()
    {
        $f = new Fleet();
        $semis = $f->allSemiReboques();
        $this->returnJson($semis);
    }
}