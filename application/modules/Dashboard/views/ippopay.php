<?php
    include_once('header.php');
?>
<script type="text/javascript" src="https://js.ippopay.com/scripts/ippopay.v1.js"></script>
<script type="text/javascript">
    var order_id;
    var options = {
        "order_id" : "<?php echo $orderId; ?>",
        "public_key" : "<?php echo $publicKey; ?>"
    }
    var orderId = "<?php echo $orderId; ?>";
    var ipay = new Ippopay(options);
    ipay.open();
    ippopayHandler(response, function (e) {
        //console.log(e)
        if(e.data.status == 'success'){
            $.get("<?php echo base_url('Dashboard/OnlinePayment/addFund');?>",{orderID:orderId,transID:e.data.transaction_no},function(res){
                window.location.href="<?php echo base_url('Dashboard/OnlinePayment/paymentGateway');?>";
            })
            console.log(e.data);
        }
        if(e.data.status == 'failure'){
            alert(e.data);
        }
    });
</script>
<?php include_once('footer.php');?>