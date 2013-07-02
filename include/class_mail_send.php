<?php
/*
	Name:			mail_send
	Description:		Simple email class which enables 
					- sending text and HTML emails with CC, BCC and attachment
					- validating email syntax and domain
	Version:			1.0
	last modified:	2010-12-17
	Autor:			Vlatko Duvnjak

*/

class mail_send
{
    private $to = array();
    private $cc = array();
    private $bcc = array();
    private $attachment = array();
    private $boundary = "";
    public $header = "";
    private $subject = "";
    private $body = "";

    function __construct()
    {
		
    }
	
	function setSenderData($name,$mail)
	{
		$this->header .= "From: $name <$mail>\n";
		$this->boundary = md5(uniqid(time()));
	}

    function to($mail)
    {
		$this->to[] = $mail;
    }

    function cc($mail)
    {
		$this->cc[] = $mail;
    }

    function bcc($mail)
    {
		$this->bcc[] = $mail;
    }

    function attachment($file)
    {
		$this->attachment[] = $file;
    }

    function subject($subject)
    {
		$this->subject = $subject;
    }

    function text($text)
    {
		$this->body = "Content-Type: text/plain; charset=ISO-8859-1\n";
		$this->body .= "Content-Transfer-Encoding: 8bit\n\n";
		$this->body .= $text."\n";
    }

    function html($html)
    {
		$this->body = "Content-Type: text/html; charset=ISO-8859-1\n";
		$this->body .= "Content-Transfer-Encoding: quoted-printable\n\n";
		$this->body .= "<html><body>\n".$html."\n</body></html>\n";
    }

	function send()
    {
        // Add CC recepient
		$max = count($this->cc);
		if($max>0)
		{
			$this->header .= "Cc: ".$this->cc[0];
			for($i=1;$i<$max;$i++)
			{
				$this->header .= ", ".$this->cc[$i];
			}
			$this->header .= "\n";
		}
		// Add BCC  recepient
		$max = count($this->bcc);
		if($max>0)
		{
			$this->header .= "Bcc: ".$this->bcc[0];
			for($i=1;$i<$max;$i++)
			{
				$this->header .= ", ".$this->bcc[$i];
			}
			$this->header .= "\n";
		}
		
		$this->header .= "MIME-Version: 1.0\n";
		$this->header .= "Content-Type: multipart/mixed; boundary=$this->boundary\n\n";
		$this->header .= "This is a multi-part message in MIME format\n";
		$this->header .= "--$this->boundary\n";
		$this->header .= $this->body;

		// Attachment 
		$max = count($this->attachment);
		if($max>0)
		{
			for($i=0;$i<$max;$i++)
			{
				$file = fread(fopen($this->attachment[$i], "r"), filesize($this->attachment[$i]));
				$this->header .= "--".$this->boundary."\n";
				$this->header .= "Content-Type: application/x-zip-compressed; name=".$this->attachment[$i]."\n";
				$this->header .= "Content-Transfer-Encoding: base64\n";
				$this->header .= "Content-Disposition: attachment; filename=".$this->attachment[$i]."\n\n";
				$this->header .= chunk_split(base64_encode($file))."\n";
				$file = "";
			}
		}
		$this->header .= "--".$this->boundary."--\n\n";
		
		// To
		foreach($this->to as $mail)
		{
			mail($mail,$this->subject,"",$this->header);
		}
    }
    
	function validateEmailSyntax($email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			//echo("Syntax for $email is <b>not</b> valid<br>");
			return false;
		}
		else 
		{
			//echo("Syntax for $email is valid<br>");
			return true;
		}
	}

	function validateEmailDomain($email)
	{
		// Check if the domain name after the @ is a real domain name. 
		// If MX record exists for that domain name, check if port 25 is open, which makes sure that the domain name is in use

		list($username, $domain) = split("@",$email);
		
		if(getmxrr($domain, $MXHost)) 
		{
		   //echo("Domain for $email is valid<br>");
		   return true;
		}
		else 
		{
		   if(@fsockopen($domain, 25, $errno, $errstr, 30)) 
		   {
			  return true; 
		   }
		   else 
		   {
			  //echo("Domain for $email is <b>not</b> valid<br>");
			  return false; 
		   }
		}
		
		

	}	
}
?>