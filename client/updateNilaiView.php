<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
 $nim = $_GET['nim'];
 $kode_mk = $_GET['kode_mk'];
//  $nilai = $_GET['nilai'];

 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
 curl_setopt($curl, CURLOPT_URL, 'http://localhost:8080/v1/nilai/'.$nim.'/'.$kode_mk.'');
 $res = curl_exec($curl);
 $json = json_decode($res, true);
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Data</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="updateNilai.php" method="put">
                        <input type = "text" name="nim" value="<?php echo"$nim";?>">
                        <input type = "text" name="kode_mk" value="<?php echo"$kode_mk";?>">
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="text" name="nilai" class="form-control" value="<?php 
                            $nilai               
                            ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>