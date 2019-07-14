<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 14.07.2019
 * Time: 17:55
 */

namespace backend\models;

use ricco\ticket\Mailer;

class TicketMailer extends Mailer
{
    public $viewPath = '@frontend/views/ticket/mail';
}