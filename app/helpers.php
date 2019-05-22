<?php
/**
 * Created by PhpStorm.
 * User: emadb
 * Date: 13/12/2018
 * Time: 10:38
 */

namespace App;

function flash($message)
{
    session()->flash('message', $message);

}

