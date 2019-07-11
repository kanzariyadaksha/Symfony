<style>
    #loading-div-background{
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.7);
    width: 100%;
    height: 100%;
    z-index: 9999;
}

    #loading-div {
        width: 350px;
        height: 200px;
        max-width: 90%;
        background-color: #fff;
        padding: 15px;
        text-align: center;
        color: #202020;
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        margin: -100px auto 0;
        behavior: url(/css/pie/PIE.htc);
        
    }
</style>
<div id="loading-div-background">
  <div id="loading-div" class="ui-corner-all">
    <img style="height:100px;width:100px;margin:15px;" src="images/please_wait.gif" alt="Loading.."/><br>Please wait while we process your request...
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $("#loading-div-background").css({ opacity: 1.0 });
    });
</script>