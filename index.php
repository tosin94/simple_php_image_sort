<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/site.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <style media="all">
        td{
            width: 500px;
            height: auto;
        }
    </style>

</head>


<body style="background-color: #D3B7AC;">
    <?php
        exec("./.script", $arr);
        $max_rows = 4;
        $row = 0;
        $num =0;
    ?>

    <?php

        function getName($name)
        {
            $len = strlen($name) - 4;
            $name = substr($name, 0, $len);

            //regex
            if (preg_match("/[0-9]/", $name))
            {
                $name = substr($name, 0,$len-1);
            }

            return $name;

        }
        function removeSlash($name)
        {
            $pattern = '/[0-9]/';
            $name = preg_replace($pattern,"",$name);

            return str_replace("-"," ",str_replace(".","",str_replace("/","",$name)));

        }
        function getPath($name)
        {
            return str_replace(":","/",$name);
        }

     ?>


    <div class="container-fluid">

        <div class="container">

            <table class="table table-striped">

                <tbody>
                    <?php
                    //print_r($arr);

                    //echo count($arr);
                    $count = count($arr);
                    while (count($arr) -1 > $num)
                    {
                        echo "<tr>";

                        for ($row; $row <= $max_rows; $row++)
                        {
                            if ($num >= count($arr) -1)
                            {
                                break;
                            }


                            if ( strpos(next($arr), "./") !== false) //if it contains "./" then it is the link and also extract header name from it
                            {
                                $link = getPath(current($arr));
                                $header = removeSlash($link);
                                echo "<tr>";
                                echo "<div style='width:100%'><td colspan=5> <h2 class='center'> $header </h2></td></div>";
                                echo "</tr>";
                                $num++;
                                break;
                            }

                            if(empty(current($arr)))
                            {
                                $num++;
                                continue;
                            }


                            else
                            {

                                $name = getName(current($arr));
                                $temp = str_replace(" ","%20",current($arr));
                                $url = $link.$temp;
                                echo "
                                    <td>
                                    <img src='$url' class='img-responsive'/> <br>
                                    <figcaption> $name </figcaption>
                                    </td>
                                    ";
                            }
                            $num++;
                        }
                        $row = 0;
                        echo "</tr>";
                    }
                ?>
                </tbody>

            </table>

        </div>

    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
