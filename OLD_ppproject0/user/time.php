<script>setInterval(function() {
  $("#a").hide();
  setTimeout(function() {
    $("#b").fadeIn('normal');
  });
}, 4000);</script>
<style>
#b {
  display: none
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div id="a">1</div>
<div id="b">2</div>
<div id="c">3</div>