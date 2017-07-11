<?php
if(!defined('__KIMS__')) exit;

function toStringTimetype($timetype)
{
	if($timetype == 'am')
		return '오전';
	elseif($timetype == 'pm')
		return '오후';
	elseif($timetype == 'nt')
		return '야간';
	else
		return '';
}