<!-- Fb share stream by API javascript--->
	<script type="text/javascript">
			function reply_click(id,caption,content,name,url,image)
			{
				alert(image);
						
						var fid=id;
						var title=caption;
						var content=content;
						var url=url;
						var image=image;
						var name=name;
						showStream(title,content,title,name,url,image,url)
			}
				var button;
				var userInfo;    
			window.fbAsyncInit = function() 
			{
			   FB.init({ appId: '716557038467744',});
               function updateButton(response) 
                {
				   button       =   document.getElementByClassName('fb-auth');
                        button.onclick = function() 
                        {
                            FB.login(function(response) 
                            {
                                if (response.authResponse) {
                                    FB.api('/me', function(info) {
                                        login(response, info);
                                        showStream();
                                       
                                    });
                                } else {
                                    //user cancelled login or did not grant authorization
                                  
                                }
                            }, {scope:'email,user_birthday,publish_actions,user_about_me'});
                        }
                    
                }
				   
                // run once with current status and whenever the status changes
                FB.getLoginStatus(updateButton);
                FB.Event.subscribe('auth.statusChange', updateButton);
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol
                    + '//connect.facebook.net/en_US/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());
 
            function login(response, info)
            {
                if (response.authResponse) 
                {
                    var accessToken =response.authResponse.accessToken;
                }
                
            }
 
            //stream publish method
            function streamPublish(caption, description, hrefTitle,name,hrefLink,image, userPrompt)
            {
               alert(image);
                FB.ui(
                {
                    method: 'stream.publish',
                    //message: 'Hai welcome this is post from api call',
                    attachment: 
                    {
						media: [{ type: "image",src: image,href: name }], // Go here if user click the picture
                        name: caption,
                        caption: name,
                        description: description,
                       // images: 'http://www.yougotrated.com/images/ygr_logos.png',
                        href:  hrefLink
                    },
                    action_links: 
                    [
                        { text: hrefTitle, href: hrefLink }
                    ],
                    user_prompt_message: userPrompt
                },
                function(response) { });
 
            }
            function showStream(rtitle,content,rtitle,name, url,image, url)
            {
				
                FB.api('/me', function(response) 
                {
                    //console.log(response.id);
                    streamPublish(rtitle,content,rtitle,name, url,image, url);
                });
            }
		
    </script>
    <!-- Fb share Ends Here--->


<div id="footer">
	<p>© <?php echo date("Y").' '.$site_name; ?></p>
</div>
<!-- /#footer -->

</div>
<!-- /#main -->
</body>
</html>
