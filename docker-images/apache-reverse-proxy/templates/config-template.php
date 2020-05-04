<?php 
	$dynamic_app1 = getenv('DYNAMIC_APP1'); 
	$dynamic_app2 = getenv('DYNAMIC_APP2');
	$static_app1 = getenv('STATIC_APP1'); 
	$static_app2 = getenv('STATIC_APP1'); 
?>
<VirtualHost *:80> 
	ServerName demo.res.ch
	
	<Proxy "balancer://dynamic>
		BalancerMember 'http://<?php print "$dynamic_app1"?>/' route=1
		BalancerMember 'http://<?php print "$dynamic_app2"?>/' route=2
	</Proxy> 
	
	<Proxy "balancer://static> 
		BalancerMember 'http://<?php print "$static_app1"?>/' route=1
		BalancerMember 'http://<?php print "$static_app2"?>/' route=2
	</Proxy> 
	
	ProxyPass '/api/students/' 'balancer://dynamic'
	ProxyPassReverse '/api/students/' 'balancer://dynamic'
	
	
	ProxyPass '/' 'balancer://static' 
	ProxyPassReverse '/' 'balancer://static' 
	
</VirtualHost> 

