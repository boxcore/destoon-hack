<?php
error_reporting(E_ALL);
header('Content-Type: text/html; charset=GBK');
function pr($arr,$exit=false){
  if ($arr === false){
    echo 'false';
  }else{
    printf('<pre>%s</pre>',var_export($arr,true));
  }
  if($exit) exit();
}
function output($str='') 
{
 echo $str."\n";
}
echo md5('123456');
echo "±àÂë";
$client = new soapclient("http://localhost:2999/api/wsdl?",array('encoding'=>'gbk'));

//output();
//output("Available actions:");
pr($client->__getFunctions());
//output();
//output();

$result = $client->CompanyAdd(123456,"<XMLData></XMLData>");
pr($result);
//$result = $client->company_details(99988);
//pr($result);

//$result = $client->emptiness("");
//output("Running emptiness({a: ''})");
//var_export($result);
//output();
//output();

//$result = $client->complex_return();
//output("Running complex_return()");
//var_export($result);
//output();
//output();

?>
