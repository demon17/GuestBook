<?php
namespace App\Controllers;

use App\Models\Guestbook;
use \Core\View;

class Home extends \Core\Controller {
    public function indexAction() {
        if($_REQUEST) {
            Guestbook::storeAll();
        }
        $guestBook = Guestbook::getAll();
        View::renderTemplate('Home/guest.html',[
            'logged' => "base.html",
            'guestBook' => $guestBook
        ]);
    }
}
?>