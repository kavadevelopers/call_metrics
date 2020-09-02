<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function pre_print($array)
{   
    echo count($array);
    echo "<pre>";
    print_r($array);
    exit;
}


function _vdatetime($datetime)
{
	return date('d-m-Y h:i A',strtotime($datetime));
}

function vd($date)
{
    return date('d-m-Y',strtotime($date));
}

function dd($date)
{
    return date('Y-m-d',strtotime($date));
}


function dt($time){
    return date('H:i:s',strtotime($time));   
}

function vt($time){
    return date('h:i A',strtotime($time));   
}

function rs()
{
    return "₹ ";
}  

function getFileExtension($filename){
    return pathinfo($filename, PATHINFO_EXTENSION);
}

function timeConverter($str){
    $arr = explode(":", $str);
    $new = "";
    foreach ($arr as $key => $value) {
        if($key != 0){
            $c = ":";
        }else{
            $c = "";
        }
        $value = trim($value,"_");
        if($value != ""){
            if(strlen($value) == 2){
                $new .= $c.$value;
            }else{
                $new .= $c."0".$value;
            }
        }else{
            $new .= $c."00";
        }
    }
    return dt($new);
}

function daysBeetweenDates($date){
    $now = time();
    $your_date = strtotime($date);
    $datediff = $now - $your_date;
    return round($datediff / (60 * 60 * 24)) - 1;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function sendMail($mail,$subject,$template)
{
    // $CI =& get_instance();
    // $config = Array(
    //     'protocol'      => 'SMTP',
    //     'smtp_host'     => $CI->config->item('mhost'),
    //     'smtp_port'     => $CI->config->item('mport'),
    //     'smtp_user'     => $CI->config->item('muser'),
    //     'smtp_pass'     => $CI->config->item('mpass'),
    //     'mailtype'      => 'html',
    //     'charset'       => 'iso-8859-1',
    //     'newline'       => "\r\n",
    //     'crlf'          => "\r\n",
    //     'wordwrap'      => TRUE
    // );
    // $CI->load->library('email', $config);
    // $CI->email->set_newline("\r\n");
    // $CI->email->from($CI->config->item('muser'));
    // $CI->email->to($mail);
    // $CI->email->subject($subject);
    // $CI->email->message($template);
    // $CI->email->send();
}
?>