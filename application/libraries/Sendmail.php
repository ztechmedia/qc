<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sendmail
{
    protected $ci;

    public function send($subject, $message, $to)
    {
        $this->ci->load->library("email");
        $config = array(
            'protocol' => EMAIL_PROTOCOL,
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'smtp_user' => SYSTEM_MAIL,
            'smtp_pass' => SYSTEM_MAILPASS,
            'mailtype' => 'html',
            'charset' => 'utf-8',
        );
        $this->ci->email->initialize($config);
        $this->ci->email->set_mailtype("html");
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->to($to);
        $this->ci->email->from(SYSTEM_MAIL, SYSTEM_MAIL_ADMIN);
        $this->ci->email->subject($subject);
        $this->ci->email->message($message);
        return $this->ci->email->send();
    }

}