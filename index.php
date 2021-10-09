<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('./database.php');
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
} else {
    if ($_SESSION['admin'] !== 'admin') {
        header('location: login.php');
    }
}
//create table mykey(id int primary key not null auto_increment, key_val varchar(255), machine_id varchar(255), expired datetime not null, status tinyint default 1);
if (isset($_POST['addkey'])) {
    $key = $_POST['key'];
    $machine_id = $_POST['machine_id'];
    $expired = $_POST['expired'];


    $database = new Database();

    $result = $database->insertInto('mykey', 'key_val, machine_id, expired, status', ':key_val, :machine_id, :expired, :status')
        ->execute(array(
            'key_val' => $key,
            'machine_id' => $machine_id,
            'expired' => $expired,
            'status' => 1
        ));

    if ($result) {
        $success = "Đã thêm vào!";
    } else {
        $error = "Lỗi khi thêm vào!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: #222D32;
            font-family: 'Roboto', sans-serif;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .login-box {
            margin-top: 75px;
            height: auto;
            background: #1A2226;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .login-key {
            height: 100px;
            font-size: 80px;
            line-height: 100px;
            background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-title {
            margin-top: 15px;
            text-align: center;
            font-size: 30px;
            letter-spacing: 2px;
            margin-top: 15px;
            font-weight: bold;
            color: #ECF0F5;
        }

        .login-form {
            margin-top: 25px;
            text-align: left;
        }

        input[type=text] {
            background-color: #1A2226;
            border: none;
            border-bottom: 2px solid #0DB8DE;
            border-top: 0px;
            border-radius: 0px;
            font-weight: bold;
            outline: 0;
            margin-bottom: 20px;
            padding-left: 0px;
            color: #ECF0F5;
        }

        input[type=password] {
            background-color: #1A2226;
            border: none;
            border-bottom: 2px solid #0DB8DE;
            border-top: 0px;
            border-radius: 0px;
            font-weight: bold;
            outline: 0;
            padding-left: 0px;
            margin-bottom: 20px;
            color: #ECF0F5;
        }

        .form-group {
            margin-bottom: 40px;
            outline: 0px;
        }

        .form-control:focus {
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-bottom: 2px solid #0DB8DE;
            outline: 0;
            background-color: #1A2226;
            color: #ECF0F5;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0;
        }

        label {
            margin-bottom: 0px;
        }

        .form-control-label {
            font-size: 10px;
            color: #6C6C6C;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-outline-primary {
            border-color: #0DB8DE;
            color: #0DB8DE;
            border-radius: 0px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .btn-outline-primary:hover {
            background-color: #0DB8DE;
            right: 0px;
        }

        .login-btm {
            float: left;
        }

        .login-button {
            padding-right: 0px;
            text-align: right;
            margin-bottom: 25px;
        }

        .login-text {
            text-align: left;
            padding-left: 0px;
            color: #A2A4A4;
        }

        .loginbttm {
            padding: 0px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/datetimepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('#picker').dateTimePicker({
                showTime: true,
                dateFormat: 'YYYY-MM-DD HH:mm',
                title: 'Chọn ngày',
                positionShift: {
                    top: -200,
                    left: -70
                },
                locale: "vi",
                buttonTitle: "Oke luôn",
                selectData: "now",
            });
            $('#result').val("<?= date('Y-m-d H:i') ?>");
        });
    </script>
    <link rel="stylesheet" href="css/datetimepicker.css">
    <title>Nhập liệu</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box pt-3">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-database" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    Thêm key vào CSDL
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form method="POST">
                            <div class="form-group">
                                <label class="form-control-label">Key</label>
                                <input type="text" class="form-control" name="key" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Mã máy</label>
                                <input type="text" class="form-control" name="machine_id" required>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Ngày hết hạn</label>
                                <div id="picker"></div>
                                <input type="hidden" id="result" name="expired" value="" required/>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <?php if (isset($error)) : ?>
                                    <div class="col-lg-6 login-btm login-text text-danger"><?= $error ?></div>
                                <?php elseif (isset($success)) : ?>
                                    <div class="col-lg-6 login-btm login-text text-success"><?= $success ?></div>
                                <?php else : ?>
                                    <div class="col-lg-6 login-btm login-text"></div>
                                <?php endif; ?>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary" name="addkey">Thêm</button>
                                    <a href="./logout.php"><button type="button" class="btn btn-outline-danger" name="addkey">Đăng xuất</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
</body>

</html>