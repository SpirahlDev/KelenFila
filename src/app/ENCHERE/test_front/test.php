<?php





$lo=new DateTime;
echo $lo->getTimestamp();




// $objects=new SplObjectStorage;

// $data=array(
//     "nom"=>array("famille"=>"Koffi","prenom"=>"yann")
// );
// $obj=new stdClass;

// $objects->attach($obj,$data);

// print_r($objects[$obj]["nom"])



// use React\EventLoop\Loop;
// use React\EventLoop\LoopInterface;
    
// // echo date_format($date->setTimestamp($date->format('s')-$i),'s')."\n";
// function hello($name, LoopInterface $loop)
// {
//     $loop->addTimer(1.0, function () use ($name) {
//         echo "hello $name\n";
//     });
// }
// $loop =Loop::get();
// hello('Tester', $loop);

// $adju[2]=array(
//     "prix"=>1,
//     "idUser"=>"9K"
// );
// $adju[0]=array(
//     "prix"=>2,
//     "idUser"=>"9K"
// );
// $adju[1]=array(
//     "prix"=>4,
//     "idUser"=>"9K"
// );

// function trierParPrix($tableau, $cle) {
//     usort($tableau, function($a, $b) use($cle) {
//         return $b[$cle] - $a[$cle];
//     });
//     return $tableau;
// }

// $adjuTrie = trierParPrix($adju, "prix");
// print_r($adjuTrie);
?>