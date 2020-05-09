<?php 
	$dynamic_app1 = getenv('DYNAMIC_APP1'); 
	$dynamic_app2 = getenv('DYNAMIC_APP2');
	$static_app1 = getenv('STATIC_APP1'); 
	$static_app2 = getenv('STATIC_APP2'); 
?>
<VirtualHost *:80> 
	ServerName demo.res.ch
	
	ProxyHCExpr gdown {%{REQUEST_STATUS} =~ /^[5]/}

	<Proxy "balancer://dynamic">
		BalancerMember 'http://<?php print "$dynamic_app1"?>' route=1 hcmethod=TCP hcinterval=5 hcpasses=2 hcfails=3
		BalancerMember 'http://<?php print "$dynamic_app2"?>' route=2 hcmethod=TCP hcinterval=5 hcpasses=2 hcfails=3
	</Proxy> 
	Header add Set-Cookie "ROUTEID=.%{BALANCER_WORKER_ROUTE}e; path=/" env=BALANCER_ROUTE_CHANGED
	<Proxy "balancer://static"> 
		BalancerMember 'http://<?php print "$static_app1"?>' route=1 hcmethod=TCP hcinterval=5 hcpasses=2 hcfails=3
		BalancerMember 'http://<?php print "$static_app2"?>' route=2 hcmethod=TCP hcinterval=5 hcpasses=2 hcfails=3
		ProxySet stickysession=ROUTEID
	</Proxy> 
	
	ProxyPass '/api/students/' 'balancer://dynamic/'
	ProxyPassReverse '/api/students/' 'balancer://dynamic/'
	
	
	ProxyPass '/' 'balancer://static/' 
	ProxyPassReverse '/' 'balancer://static/' 
	
</VirtualHost> 

