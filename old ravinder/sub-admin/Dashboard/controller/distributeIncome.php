<?php

class distributeIncome{
    
    public function directIncome($db,$user,$username,$amount,$from){        
        $desc = "Direct income";   
        mysqli_query($db,"INSERT INTO `wallet`(`userId`, `username`, `amount`, `type`, `fromUserId`, `description`, `level`, `transaction_type`, `walletType`) VALUES ('$user','$username','$amount','credit','$from','$desc','1','direct_income','inr')");
           
    }
}

