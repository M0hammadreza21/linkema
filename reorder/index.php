<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Drag and Drop Table Rows In PHP Mysql</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style type="text/css">
        body{
            background:#d1d1d2;
        }
        .mian-section{
            padding:20px 60px;
            margin-top:100px;
            background:#fff;
        }
        .title{
            margin-bottom:50px;
        }
        .label-success{
            position: relative;
            top:20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mian-section">
                <h3 class="text-center title">Dynamic Drag and Drop Table Rows In PHP Mysql <label class="label label-success">nicesnippets.com</label></h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                    <tbody class="row_position">
                    <?php
                            $host = "localhost"; /* Host name */
    $user = "linkemac_mohammadreza"; /* User */
    $password = "pyax}nO-[nYW"; /* Password */
    $dbname = "linkemac_database"; /* Database name */

    $con = mysqli_connect($host, $user, $password,$dbname);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
                        $sql = "SELECT * FROM messengers WHERE pid = 2 ORDER BY position_order";
                        $messengers = $con->query($sql);
                        while($messenger = $messengers->fetch_assoc()){
                    ?>
                        <tr id="<?php echo $messenger['messenger_id'] ?>">
                            <td><?php echo $messenger['messenger_id'] ?></td>
                            <td><?php echo $messenger['title'] ?></td>
                            <td><?php echo $messenger['type'] ?></td>
                        </tr>
                    <?php 
                        } 
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        $(".row_position").sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>tr').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });
        function updateOrder(data) {
            $.ajax({
                url:"ajaxPro.php",
                type:'post',
                data:{position:data},
                success:function(data){
                    toastr.success('Your Change Successfully Saved.');
                }
            })
        }
    </script>
</body>
</html>