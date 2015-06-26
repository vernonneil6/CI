<div class="option facebookcolor" onclick="FBLogin();"><i class="fa fa-facebook facebookboder"></i><span>Create an account with Facebook</span></div>


<script>
window.fbAsyncInit = function() {
FB.init({
appId      : '540638299357869',
status     : true, 
cookie     : true,
xfbml      : true,
oauth      : true
});

FB.Event.subscribe('auth.login', function(response) {
if (response.status === 'connected') {
top.location.href ='http://www.yougotrated.com/fbtest/fblogin';
}
});
FB.Event.subscribe('auth.logout', function(response) {
if (response.status === 'connected') {
}
else
{
top.location.href ='http://www.yougotrated.com/fbtest/logout';
}
});

 };
(function(d){
var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
d.getElementsByTagName('head')[0].appendChild(js);
}(document));
function FBLogin(){
    FB.login(function(response){
        if(response.authResponse){
            window.location.href = "http://www.yougotrated.com/fbtest/fblogin";
        }
    }, {scope: 'email'});
}

</script>
