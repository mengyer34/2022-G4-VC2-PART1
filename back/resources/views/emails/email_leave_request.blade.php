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
                                   <td style=" padding-top: 30px; padding-bottom: 5px; background-color: white; " > <span style="color: #363636" >Dear <b>Admin,</b></span > </td>
                                </tr>
                                <tr>
                                   <td style=" padding-top: 5px; padding-bottom: 9px; background-color: white; " > 
                                    <span style="color: #363636;" >
                                       Due to a student's request for a leave of absence, please check the SLMS (Student Leave Management System).
                                    </span > </td>
                                </tr>
                                <tr style="background-color: #9ff59980;">
                                   <td style=" padding: 16px; border-collapse: collapse; border-radius: 8px; " >
                                      <div style="color: #363636;"> Here is more information on student leave</div>
                                      <table style="width:100%; text-align: left; margin-top: 10px; border: 1px solid black; border-collapse: collapse; font-size: 14px">
                                       <tr>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">From :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">{{ $details['email'] }}</td>
                                       </tr>
                                       <tr>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">Reason :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">{{ $details['reason'] }}</td>
                                       </tr>
                                       <tr>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">Leave type :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">{{ $details['leave_type'] }}</td>
                                       </tr>
                                       <tr>
                                        <?php 
                                          $startDate = date("F j, Y", strtotime($details['start_date']));
                                        ?>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">Start date :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">{{ $startDate }} {{$details['start_time']}}</td>
                                       </tr>
                                       <tr>
                                          <?php 
                                            $endDate = date("F j, Y", strtotime($details['end_date']));
                                          ?>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">End date :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">{{ $endDate }} {{$details['end_time']}}</td>
                                       </tr>
                                       <tr>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">Status :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">Pending</td>
                                       </tr>
                                       <tr>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">Duration :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">{{ $details['duration'] }}</td>
                                       </tr>
                                       <tr>
                                         <th style="border-collapse: collapse; padding: 5px; width: 100px;">Request date :</th>
                                         <td style="border-collapse: collapse; padding: 5px;">{{date("F j, Y, g:i a")}}</td>
                                       </tr>
                                     </table>
                                   </td>
                                </tr>
                                <tr>
                                   <td style="background: #ffffff; height: 20px">
                                    <button style=" border-radius: 2px; margin-top: 10px; border: none; background: #0000FF; padding: 10px;">
                                      <a href="{{ $details['urlApp'] }}" style=" border-radius: 2px; margin-top: 10px; border: none; color: #fff; padding: 10px; text-decoration: none;">Check on app</a>
                                    </button>
                                  </a>
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
