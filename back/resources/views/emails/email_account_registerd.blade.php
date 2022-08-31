<body style="font-family: Arial; margin: 0; font-size: 20px">
  <table style=" background-color: #f3f3f5; padding: 16px 12px; min-height: 100vh; width: 80%; margin: 0 auto; " >
     <tbody>
        <tr>
           <td style="vertical-align: top">
              <table border="0" width="600" cellpadding="0" cellspacing="0" align="center" style=" width: 600px !important; min-width: 600px !important; max-width: 600px !important; margin: auto; border-spacing: 0; border-collapse: collapse; background: white; border-radius: 8px; padding-left: 30px; padding-right: 30px; padding-top: 30px; padding-bottom: 30px; display: block; " >
                 <tbody>
                    <tr>
                       <td style=" text-align: center; vertical-align: top; border-collapse: collapse; " >
                          <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#F8F8F8" style="border-spacing: 0; border-collapse: collapse" >
                             <tbody>
                                <tr style="background-size: cover">
                                   <td style=" width: 60%; text-align: left; border-collapse: collapse; background: #fff; border-radius: 10px 10px 0px 0px; color: white; height: 50px; " > <img src="https://www.passerellesnumeriques.org/misc/logo-en.png" width="120px" class="CToWUd"/> </td>
                                   <td style=" width: 40%; text-align: right; border-collapse: collapse; background: #fff; border-radius: 10px 10px 0px 0px; color: white; height: 50px; " >
                                      <div style="color: #828282; font-size: 14px"> {{date("F j, Y, g:i a")}} </div>
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </td>
                    </tr>
                    <tr>
                       <td style="vertical-align: top; border-collapse: collapse">
                          <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#F8F8F8" style="border-spacing: 0; border-collapse: collapse" >
                             <tbody style="font-size: 14px;">
                                <tr>
                                   <td style=" padding-top: 30px; padding-bottom: 5px; background-color: white; " > <span style="color: #363636" >Hi <b>{{ $details['first_name'] }} {{ $details['last_name'] }},</b></span > </td>
                                </tr>
                                <tr>
                                   <td style=" padding-top: 5px; padding-bottom: 9px; background-color: white; " > <span style="color: #363636;" >Your SLMS (Student Leave Management System) account has created. Please login with infomation below 👇, and you can change password.</span > </td>
                                </tr>
                                <tr style="background-color: #9ff59980;">
                                   <td style=" padding: 16px; border-collapse: collapse; border-radius: 8px; " >
                                      <div style="color: #363636;"> Here is your information to login into account </div>
                                      <div style=" margin-top: 10px; color: #444;font-weight: 100; align-items: center; display: flex;" > 
                                        <span>Email: </span>                                       
                                        <span style=" margin-left: 5px; font-weight: bold;">{{ $details['email'] }}</span>
                                      </div>
                                      <div style=" margin-top: 8px; color: #444;font-weight: 100; align-items: center; display: flex; " >
                                        <span>Password: </span>                                       
                                        <span style=" margin-left: 5px; font-weight: bold;">{{ $details['password'] }}</span> 
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td style="background: #ffffff; height: 20px">
                                    <button style=" border-radius: 2px; margin-top: 10px; border: none; background: #0000FF; padding: 10px;">
                                      <a href="{{ $details['linkTo'] }}" style=" border-radius: 2px; margin-top: 10px; border: none; color: #fff; padding: 10px; text-decoration: none;">Login Now</a>
                                    </button>
                                  </td>
                                </tr>
                                <tr>
                                   <td style="background: #ffffff; height: 20px"></td>
                                </tr>
                                <tr>
                                   <td bgcolor="#F8F8F8" style=" border-radius: 8px !important; border-collapse: collapse; " ></td>
                                </tr>
                             </tbody>
                          </table>
                       </td>
                    </tr>
                 </tbody>
              </table>
           </td>
        </tr>
     </tbody>
  </table>
 </body>