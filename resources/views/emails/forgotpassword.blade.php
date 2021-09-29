<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forgot Password</title>
</head>
<body style="box-sizing: border-box; padding: 0; margin: 0px;">
    <section style="background-position: center; background-repeat: no-repeat;
    background-size: cover; height: 100%; min-height: 100vh; width: 100%; float: left; padding: 60px 0px;">        
        <div style="max-width: 900px; width: 100%; margin: auto; background-color: white; border-radius: 20px; padding: 50px 0px;">
          
                <div style=" width: 100%; float: left;">
                  <div style="align-items: center;  max-width: 550px; margin: auto; text-align: center;">                  
                  </div>

                  <div class="row justify-content-center">                      
                            <p class="join_group_para"> Hi {{$user_name}},  
								Your OTP IS - {{$otp_send}} </p>
                  </div>
                </div>
         </div>
    </section>

</body>
</html>
