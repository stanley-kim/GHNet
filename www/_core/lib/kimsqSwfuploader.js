function makeKimsqSwfuploader()
{
	var flashVar = '';
	var flashStr = '';

	flashVar += "limitSize="+limitSize+"&amp;";
	flashVar += "limitFile="+limitFile+"&amp;";
	flashVar += "ftypeName="+ftypeName+"&amp;";
	flashVar += "ftypeExt1="+ftypeExt1+"&amp;";
	flashVar += "ftypeExt2="+ftypeExt2+"&amp;";
	flashVar += "quploader="+quploader+"&amp;";
	flashVar += "qupload_m="+qupload_m+"&amp;";
	flashVar += "qupload_a="+qupload_a+"&amp;";
	flashVar += "object_Id="+object_Id+"&amp;";
	flashVar += "sess_Code="+sess_Code+"&amp;";
	flashVar += "Permision="+Permision+"&amp;";
	flashVar += "Overwrite="+Overwrite+"&amp;";
	flashVar += "save_Path="+save_Path;

	flashStr  = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" ';
	flashStr += 'width="'+swf_width+'" height="'+swfheight+'" id="'+object_Id+'">';
	flashStr += '<param name="allowScriptAccess" value="sameDomain" />';
	flashStr += '<param name="quality" value="high" />';
	flashStr += '<param name="movie" value="'+flash_Src+'" />';
	flashStr += '<param name="bgcolor" value="'+swbgcolor+'" />';
	flashStr += '<param name="flashvars" value="'+flashVar+'" />';
	flashStr += '<embed src="'+flash_Src+'" width="'+swf_width+'" height="'+swfheight+'" quality="high" ';
	flashStr += 'bgcolor="'+swbgcolor+'" name="'+object_Id+'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" ';
	flashStr += 'pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+flashVar+'" /></embed></object>&nbsp;';

	document.write(flashStr); 

}
function getFileSize(size)
{
	size = parseInt(size);
	return commaSplit(parseInt(size/1024)) + 'KB';
	//return size/1024 > 1024 ? parseInt(size/1024/1024) + 'MB' : parseInt(size/1024) + 'KB';
}
function KIMSQ_SWF_EVENT_LISTENER(key)
{

	val = key.split(':');
	var i = 0;
	i++;

	//νμΌμ ν
	if (val[0] == 'SELECTED')
	{
		getId('progress').style.display = 'block';
		getId('remainnum').innerHTML = val[1];
		getId('totalnum').innerHTML = val[1];
		getId('totalsize').innerHTML = getFileSize(val[2]);
	}
	//μ νμ©λμ΄κ³Ό
	if (val[0] == 'OVERSIZE')
	{
		getId('progress').style.display = 'none';
		alert('μ©λμ΄ μ΄κ³Όλμ΄ μ νμ©λλ΄μμ μ²¨λΆλμμ΅λλ€.     ');
		//alert('μ²¨λΆκ°λ₯μ©λ : ' + getFileSize(val[1]) + ' / νμ¬μ²¨λΆμ©λ : ' + getFileSize(val[2]));
	}
	//μ²¨λΆκ°―μμ΄κ³Ό
	if (val[0] == 'OVERNUM')
	{
		getId('progress').style.display = 'none';
		alert('κ°―μκ° μ΄κ³Όλμ΄ μ νκ°―μλ΄μμ μ²¨λΆλμμ΅λλ€.     ');
		//alert('μ²¨λΆκ°λ₯κ°―μ : ' + val[1] + 'κ° / νμ¬μ²¨λΆκ°―μ : ' + val[2] + 'κ°');
	}
	//νμΌνμ₯μμ ν
	if (val[0] == 'DENYEXP')
	{
		alert(val[1] + 'νμΌμ μ²¨λΆκ° μ μΈλμμ΅λλ€.');
	}
	//μ§νμν
	if (val[0] == 'PROGRESS')
	{
		getId('filename').innerHTML = val[1] + '('+getFileSize(val[2])+')';
		getId('filepers').innerHTML = parseInt(parseInt(val[3]) / parseInt(val[4]) * 100) + '%';
		getId('filegrap').style.width = parseInt(parseInt(val[3]) / parseInt(val[4]) * 100) + '%';
	}
	//κ°λ³νμΌμλ‘λμλ£
	if (val[0] == 'UPLOADED')
	{
		getId('filename').innerHTML = 'μ μ‘μλ£';
		getId('filepers').innerHTML = '0%';
		getId('filegrap').style.width = '0px';
		getId('remainnum').innerHTML = parseInt(getId('remainnum').innerHTML) - 1;
		if (getId('remainnum').innerHTML == '0')
		{
			getId('progress').style.display = 'none';
			if (getCookie('TmpCode') == '')
			{
				setCookie('TmpCode',sess_Code,1);
			}
			location.reload();
		}
	}
	//λ€νΈμν¬μλ¬
	if (val[0] == 'HTTPERROR')
	{
		alert("λ€νΈμν¬ μλ¬κ° λ°μνμμ΅λλ€. κ΄λ¦¬μμκ² λ¬ΈμνμΈμ.");
	}
	//μμΆλ ₯μλ¬
	if (val[0] == 'IOERROR')
	{
		alert("μμΆλ ₯ μλ¬κ° λ°μνμμ΅λλ€.\nλ€λ₯Έ νλ‘κ·Έλ¨μμ μ΄ νμΌμ μ¬μ©μ€μΈμ§ νμΈνμΈμ.");
	}
	//λ³΄μμλ¬
	if (val[0] == 'SECUERROR')
	{
		alert("λ³΄μ μλ¬κ° λ°μνμμ΅λλ€. κ΄λ¦¬μμκ² λ¬ΈμνμΈμ.");
	}
	//κΆνμμ
	if (val[0] == 'PERMERROR')
	{
		alert("μ²¨λΆκΆνμ΄ μμ΅λλ€.");
	}
}
