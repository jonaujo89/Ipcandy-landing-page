<?php

namespace LPCandy\Controllers;

class Email extends Base {   
    
    static $instance;

    /**  @return Email  */
    static function get() {
        if (!Email::$instance) Email::$instance = new Email();
        return Email::$instance;
    }
    
    function __construct() {
        $this->data = array();
        $config = \Bingo\Config::get('config', 'smtp');

        $mail = new \PHPMailer(true);

        $mail->IsSMTP();
        $mail->Host = $config['host'];
        $mail->Port = $config['port'];
        $mail->CharSet = 'utf-8';

        if ($config['username']) {
            $mail->SMTPAuth = true;
            $mail->Username   = $config['username'];
            $mail->Password   = $config['password'];
        }
        $this->mail = $mail;
    }    
    
    function send($to,$subject,$template,$data,$from=false) {
        
        if (!$from) {
            $domain = \Bingo\Config::get('config', 'domain')[bingo_get_locale()];
            $from = ['email'=>'info@'.$domain,'name'=>_t('LPCandy')];
        }
        
        try {
            $mail = $this->mail;
            $mail->SetFrom($from['email'],@$from['name']);
            $mail->Subject = $subject;

            if ($template) {
                $old_base = \Bingo\Template::$base;
                theme_base();
                \Bingo\Template::$base = \Bingo\Template::$base."/lpcandy/emails";
                $template = $this->view($template,$data,true);
                template_base($old_base);
            } else {
                $template = $data;
            }
            
            $mail->MsgHTML($template);

            $mail->ClearAddresses();
            $mail->AddAddress($to['email'],@$to['name']);

            if (!$mail->Send()) {
                trigger_error($mail->ErrorInfo);
                return false;
            } else {
                return true;
            }

        } catch (\Exception $e) {
            trigger_error($e->getMessage());
            return false;
        }
    }
    
    function sendTrackNotification($track) {
        if (!$track->user->email) return;

        $emails = explode(" ",$track->user->email);
        foreach ($emails as $email) {
            $email = trim($email);
            if (!$email) continue;

            $to = ['email'=>$email,'name'=>$track->user->name];
            $subject = str_replace("{id}",$track->id,_t('LPCandy: you have a new form submission {id}'));
            $this->send($to,$subject,$tpl = 'track_notification',$data = ['track'=>$track]);
        }
    }
}
