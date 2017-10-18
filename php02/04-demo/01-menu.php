<?php

$array = array( "新款连衣裙","四件套","潮流T恤","时尚女鞋","短裤","半身裙","男士外套","墙纸","行车记录仪","新款男鞋","耳机" );

$length = count( $array );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style> 
        ul, li {
            padding: 0;
            margin: 0;
        }

        ul {
            background-color: #ccc;
        }

        li {
            list-style: none;
            float: left;
            margin-right: 20px;
            padding: 5px 0;
        }

        ul a {
            text-decoration: none;
            font-weight: bolder;
        }

        ul a:hover {
            color: red;
        }

        .clear {
            clear:both;
        }
        
    </style>         
</head>
<body>
    <ul>
       <?php for ( $i = 0; $i < $length; $i++ ) { ?>
       <li><a href="#"><?php echo "$array[$i]" ?></a></li>
       <?php } ?>
        <div class="clear"></div>
    </ul>
</body>
</html>