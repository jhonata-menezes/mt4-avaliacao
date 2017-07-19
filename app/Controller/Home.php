<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 20:43
 */

namespace Mt4\ContatosAvaliacao\Controller;

use Mt4\ContatosAvaliacao\View\View;

class Home extends AbstractController
{
    public function run()
    {
       View::parse('home', ['nome' => 'Jhonata Menezes']);
    }
}