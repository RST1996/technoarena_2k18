<?php
	function ta_reg_mail($reg_id)
	{
		global $dbcon;
		$query = "SELECT * FROM `registration` WHERE `id` = '$reg_id'";
		if($res = mysqli_query($dbcon,$query))
		{
			if(mysqli_num_rows($res) == 1)
			{
				$row = mysqli_fetch_assoc($res);
				$name = $row['name'];
				$ta_id = $row['ta_id'];
				$email = $row['email'];
				$clg_name = $row['clg_name'];
				$nop = $row['nop'];
				$mob_no = $row['mob_no'];
				$fees_paid = $row['fees_paid'];
				$event_id = $row['event_id'];
				$event_query = "SELECT `name` FROM `events` WHERE `id` = '$event_id'";
				if($res = mysqli_query($dbcon,$event_query))
				{
					$row = mysqli_fetch_assoc($res);
					$event_name = $row['name'];
				}
				$part_array = array();
				$paticipant_query = "SELECT `name` FROM `participants` WHERE `reg_id` = '$reg_id'";
				if($res = mysqli_query($dbcon,$paticipant_query))
				{
					$sr = 1;
					while($row = mysqli_fetch_assoc($res))
					{
						$pname = $row['name'];
						$part_array[] = "$sr. &nbsp;&nbsp; $pname";
						$sr++;
					}
				}
				$part_str = implode("<br/>", $part_array);

			}
		}
		else
			die();
		$mail = new TA18Mailer;
		//$mail->SMTPDebug = 2; 
		$mail->isSMTP();
		$mail->Subject = 'TA18 event registration';
		$mail->setFrom('no-reply@technoarena.gcoej.ac.in', 'TECHNOARENA 2K18');
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Body = "
			<!doctype html>
			<html>
			  <head>
			    <meta name=\"viewport\" content=\"width=device-width\" />
			    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			    <title>Registration Success</title>
			    <style>
			      /* -------------------------------------
			          GLOBAL RESETS
			      ------------------------------------- */
			      img {
			        border: none;
			        -ms-interpolation-mode: bicubic;
			        max-width: 100%; }

			      body {
			        background-color: #f6f6f6;
			        font-family: sans-serif;
			        -webkit-font-smoothing: antialiased;
			        font-size: 14px;
			        line-height: 1.4;
			        margin: 0;
			        padding: 0;
			        -ms-text-size-adjust: 100%;
			        -webkit-text-size-adjust: 100%; }

			      table {
			        border-collapse: separate;
			        mso-table-lspace: 0pt;
			        mso-table-rspace: 0pt;
			        width: 100%; }
			        table td {
			          font-family: sans-serif;
			          font-size: 14px;
			          vertical-align: top; }

			      /* -------------------------------------
			          BODY & CONTAINER
			      ------------------------------------- */

			      .body {
			        background-color: #f6f6f6;
			        width: 100%; }

			      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
			      .container {
			        display: block;
			        Margin: 0 auto !important;
			        /* makes it centered */
			        max-width: 580px;
			        padding: 10px;
			        width: 580px; }

			      /* This should also be a block element, so that it will fill 100% of the .container */
			      .content {
			        box-sizing: border-box;
			        display: block;
			        Margin: 0 auto;
			        max-width: 580px;
			        padding: 10px; }

			      /* -------------------------------------
			          HEADER, FOOTER, MAIN
			      ------------------------------------- */
			      .main {
			        background: #ffffff;
			        border-radius: 3px;
			        width: 100%; }

			      .wrapper {
			        box-sizing: border-box;
			        padding: 20px; }

			      .content-block {
			        padding-bottom: 10px;
			        padding-top: 10px;
			      }

			      .footer {
			        clear: both;
			        Margin-top: 10px;
			        text-align: center;
			        width: 100%; }
			        .footer td,
			        .footer p,
			        .footer span,
			        .footer a {
			          color: #999999;
			          font-size: 12px;
			          text-align: center; }

			      /* -------------------------------------
			          TYPOGRAPHY
			      ------------------------------------- */
			      h1,
			      h2,
			      h3,
			      h4 {
			        color: #000000;
			        font-family: sans-serif;
			        font-weight: 400;
			        line-height: 1.4;
			        margin: 0;
			        Margin-bottom: 30px; }

			      h1 {
			        font-size: 35px;
			        font-weight: 300;
			        text-align: center;
			        text-transform: capitalize; }

			      p,
			      ul,
			      ol {
			        font-family: sans-serif;
			        font-size: 14px;
			        font-weight: normal;
			        margin: 0;
			        Margin-bottom: 15px; }
			        p li,
			        ul li,
			        ol li {
			          list-style-position: inside;
			          margin-left: 5px; }

			      a {
			        color: #3498db;
			        text-decoration: underline; }

			      /* -------------------------------------
			          BUTTONS
			      ------------------------------------- */
			      .btn {
			        box-sizing: border-box;
			        width: 100%; }
			        .btn > tbody > tr > td {
			          padding-bottom: 15px; }
			        .btn table {
			          width: auto; }
			        .btn table td {
			          background-color: #ffffff;
			          border-radius: 5px;
			          text-align: center; }
			        .btn a {
			          background-color: #ffffff;
			          border: solid 1px #3498db;
			          border-radius: 5px;
			          box-sizing: border-box;
			          color: #3498db;
			          cursor: pointer;
			          display: inline-block;
			          font-size: 14px;
			          font-weight: bold;
			          margin: 0;
			          padding: 12px 25px;
			          text-decoration: none;
			          text-transform: capitalize; }

			      .btn-primary table td {
			        background-color: #3498db; }

			      .btn-primary a {
			        background-color: #3498db;
			        border-color: #3498db;
			        color: #ffffff; }

			      /* -------------------------------------
			          OTHER STYLES THAT MIGHT BE USEFUL
			      ------------------------------------- */
			      .last {
			        margin-bottom: 0; }

			      .first {
			        margin-top: 0; }

			      .align-center {
			        text-align: center; }

			      .align-right {
			        text-align: right; }

			      .align-left {
			        text-align: left; }

			      .clear {
			        clear: both; }

			      .mt0 {
			        margin-top: 0; }

			      .mb0 {
			        margin-bottom: 0; }

			      .preheader {
			        color: transparent;
			        display: none;
			        height: 0;
			        max-height: 0;
			        max-width: 0;
			        opacity: 0;
			        overflow: hidden;
			        mso-hide: all;
			        visibility: hidden;
			        width: 0; }

			      .powered-by a {
			        text-decoration: none; }

			      hr {
			        border: 0;
			        border-bottom: 1px solid #f6f6f6;
			        Margin: 20px 0; }

			      /* -------------------------------------
			          RESPONSIVE AND MOBILE FRIENDLY STYLES
			      ------------------------------------- */
			      @media only screen and (max-width: 620px) {
			        table[class=body] h1 {
			          font-size: 28px !important;
			          margin-bottom: 10px !important; }
			        table[class=body] p,
			        table[class=body] ul,
			        table[class=body] ol,
			        table[class=body] td,
			        table[class=body] span,
			        table[class=body] a {
			          font-size: 16px !important; }
			        table[class=body] .wrapper,
			        table[class=body] .article {
			          padding: 10px !important; }
			        table[class=body] .content {
			          padding: 0 !important; }
			        table[class=body] .container {
			          padding: 0 !important;
			          width: 100% !important; }
			        table[class=body] .main {
			          border-left-width: 0 !important;
			          border-radius: 0 !important;
			          border-right-width: 0 !important; }
			        table[class=body] .btn table {
			          width: 100% !important; }
			        table[class=body] .btn a {
			          width: 100% !important; }
			        table[class=body] .img-responsive {
			          height: auto !important;
			          max-width: 100% !important;
			          width: auto !important; }}

			      /* -------------------------------------
			          PRESERVE THESE STYLES IN THE HEAD
			      ------------------------------------- */
			      @media all {
			        .ExternalClass {
			          width: 100%; }
			        .ExternalClass,
			        .ExternalClass p,
			        .ExternalClass span,
			        .ExternalClass font,
			        .ExternalClass td,
			        .ExternalClass div {
			          line-height: 100%; }
			        .apple-link a {
			          color: inherit !important;
			          font-family: inherit !important;
			          font-size: inherit !important;
			          font-weight: inherit !important;
			          line-height: inherit !important;
			          text-decoration: none !important; }
			        .btn-primary table td:hover {
			          background-color: #34495e !important; }
			        .btn-primary a:hover {
			          background-color: #34495e !important;
			          border-color: #34495e !important; } }

			    </style>
			  </head>
			  <body>
			    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"body\">
			      <tr>
			        <td>&nbsp;</td>
			        <td class=\"container\">
			          <div class=\"content\">

			            <!-- START CENTERED WHITE CONTAINER -->
			            <span class=\"preheader\">Successfull Registration at TECHNOARENA 2K18. Here are your details.</span>
			            <table class=\"main\">

			              <!-- START MAIN CONTENT AREA -->
			              <tr>
			                <td class=\"wrapper\">
			                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			                  	<tr>
			                  		<img src=\"https://technoarena.gcoej.ac.in/registration/img/01.png\"></img>
			                  	</tr>
			                    <tr>
			                      <td>
			                      	<br/>
			                        <p>Hi  $name,</p>
			                        <p>You have been successfully registered at TECHNOARENA 2K18 <br/>
			                        	<b>TA ID:- </b> $ta_id<br/>
			                        	<b>Event Name:- </b> $event_name<br/>
			                        	<b>Members</b><br/>
			                        	$part_str<br/>
			                        	<b>Fees Paid:- </b>$fees_paid;
			                        </p>
			                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"btn btn-primary\">
			                          <tbody>
			                            <tr>
			                              <td align=\"left\">
			                                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			                                  <tbody>
			                                    <tr>
			                                      <td> <a href=\"http://technoarena.gcoej.ac.in\" target=\"_blank\">Visit Website</a> </td>
			                                    </tr>
			                                  </tbody>
			                                </table>
			                              </td>
			                            </tr>
			                          </tbody>
			                        </table>
			                        <p>Have a nice time.</p>
			                        <p>Se you @ TECHNOARENA 2K18</p>
			                      </td>
			                    </tr>
			                  </table>
			                </td>
			              </tr>

			            <!-- END MAIN CONTENT AREA -->
			            </table>

			            <!-- START FOOTER -->
			            <div class=\"footer\">
			              <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			                <tr>
			                  <td class=\"content-block\">
			                    <span class=\"apple-link\">Technoarena 2K18 ORS(Online Registration System)</span>
			                  </td>
			                </tr>
			                <tr>
			                  <td class=\"content-block powered-by\">
			                    Powered by <a href=\"https://sdc.gcoej.ac.in\">SDC, GCOEJ</a>.
			                  </td>
			                </tr>
			              </table>
			            </div>
			            <!-- END FOOTER -->

			          <!-- END CENTERED WHITE CONTAINER -->
			          </div>
			        </td>
			        <td>&nbsp;</td>
			      </tr>
			    </table>
			  </body>
			</html>";
		$mail->AltBody = "Hello $name. Your TA ID is $ta_id. Use it for future references at TECHNOARENA 2K18. See you there.!! :)";
		if(!$mail->send()) {
			return false;
		} 
		else
		{
			//echo 'Mailed Successfull';
			return true;
		}
	}
?>