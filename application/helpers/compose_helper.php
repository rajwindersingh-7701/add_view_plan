<?php
    if(!function_exists('composeMail')){ 
        function composeMail($email,$subject,$message,$display=false){
            if(!empty($email)){
                // Integrate by MV 
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.zeptomail.in/v1.1/email",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => '{
                    "bounce_address":"'.bounce_address.'",
                    "from": { "address": "'.from.'"},
                    "to": [{"email_address": {"address": "'.$email.'"}}],
                    "subject":"'.$subject.'",
                    "htmlbody":"<div><b>'.$message.' </b></div>",
                    }',
                        CURLOPT_HTTPHEADER => array(
                            "accept: application/json",
                            "authorization: ".authorization,
                            "cache-control: no-cache",
                            "content-type: application/json",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

            }
            if($display == true){
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }
                // echo json_encode($data);
            }
        }
    }

?>