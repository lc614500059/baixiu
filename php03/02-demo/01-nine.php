
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .row {
            width: 963px;
            background-color: pink;
        }
        .clear {
            clear: both;
        }
        .column {
            width: 100px;
            float: left;
            margin-right: 5px;
            margin-bottom: 10px;
            text-align: center;
            border: 1px dashed blue;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <?php for ( $j=1; $j<10; $j++ ) { ?>
            <div class="row">
                <?php for( $i=1; $i<=$j; $i++ ){ ?>
                <div class="column"><?php printf( "%d * %d = %d ",$i,$j,$i*$j ); ?></div>
                <?php } ?>
            <div class="clear"></div>
                    
            </div>
        <?php } ?>
    </div>
</body>
</html>