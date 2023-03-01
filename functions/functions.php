<?php 
require "connection.php";

date_default_timezone_set('Asia/Jakarta');

function add_staff() {
    global $conn;
    $query = "SELECT * FROM tb_user WHERE role = 'staff' ORDER BY username DESC";
    $data = mysqli_query($conn, $query);
    // echo mysqli_num_rows($data);
    if (mysqli_num_rows($data) == 0){
        $id_user = 1001;
    } else {
        $result = mysqli_fetch_assoc($data);
        $arr_result = explode('-', $result['username']);
        $id_user = end($arr_result) + 1;
    }

    $username = 'staff-' . $id_user;
    return $username;
}

function add_supplier() {
    global $conn;
    $query = "SELECT * FROM tb_user WHERE role = 'supplier' ORDER BY username DESC";
    $data = mysqli_query($conn, $query);
    // echo mysqli_num_rows($data);
    if (mysqli_num_rows($data) == 0){
        $id_user = 1001;
    } else {
        $result = mysqli_fetch_assoc($data);
        $arr_result = explode('-', $result['username']);
        $id_user = end($arr_result) + 1;
    }

    $username = 'supp-' . $id_user;
    return $username;
}

function id_transaction($status) {
    global $conn;

    $date = date("Ymd");

    $id_transaksi = "TR" . $date . "/";
    if ($status == "in") {
        $id_transaksi .= "IN/";

        $query = "SELECT * FROM tb_transaksi WHERE status = '$status' ORDER BY id_transaksi DESC";
        $data = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($data);
        @$arr_result = explode('/', $result['id_transaksi']);

        $arr_date_db = explode('TR', $arr_result[0]);
        $date_db = end($arr_date_db);

        if ($date > $date_db) {
            $count = 1;
        } else {
            if (mysqli_num_rows($data) == 0) {
                $count = 1;
            } else {
                $count = end($arr_result) + 1;
            }
        }

        $id_transaksi .= $count;
    } else if ($status == "out") {
        $id_transaksi .= "OUT/";

        $query = "SELECT * FROM tb_transaksi WHERE status = '$status' ORDER BY id_transaksi DESC";
        $data = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($data);
        @$arr_result = explode('/', $result['id_transaksi']);

        $arr_date_db = explode('TR', $arr_result[0]);
        $date_db = end($arr_date_db);

        if ($date > $date_db) {
            $count = 1;
        } else {
            if (mysqli_num_rows($data) == 0) {
                $count = 1;
            } else {
                $count = end($arr_result) + 1;
            }
        }

        $id_transaksi .= $count;
    }

    return $id_transaksi;
}

function redirect_session($directory, $role) {
    session_start();
    if ($directory == 1) {
        if ($role == "supplier") {
            if (!$_SESSION['signin']) {
                header("Location: ../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "staff") {
                header("Location: ../staff/");
                exit;
            } else if ($_SESSION['user_role'] == "manager") {
                header("Location: ../manager/");
                exit;
            }
        } else if ($role == "staff") {
            if (!$_SESSION['signin']) {
                header("Location: ../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "supplier") {
                header("Location: ../supplier/");
                exit;
            } else if ($_SESSION['user_role'] == "manager") {
                header("Location: ../manager/");
                exit;
            }
        } else if ($role == "manager") {
            if (!$_SESSION['signin']) {
                header("Location: ../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "supplier") {
                header("Location: ../supplier/");
                exit;
            } else if ($_SESSION['user_role'] == "staff") {
                header("Location: ../staff/");
                exit;
            }
        } else if ($role == "signin") {
            if (@$_SESSION['user_role'] == "supplier") {
                header("Location: ../supplier/");
                exit;
            } else if (@$_SESSION['user_role'] == "staff") {
                header("Location: ../staff/");
                exit;
            } else if (@$_SESSION['user_role'] == "manager") {
                header("Location: ../manager/");
                exit;
            }
        }
    } else if ($directory == 2) {
        if ($role == "supplier") {
            if (!$_SESSION['signin']) {
                header("Location: ../../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "staff") {
                header("Location: ../../staff/");
                exit;
            } else if ($_SESSION['user_role'] == "manager") {
                header("Location: ../../manager/");
                exit;
            }
        } else if ($role == "staff") {
            if (!$_SESSION['signin']) {
                header("Location: ../../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "supplier") {
                header("Location: ../../supplier/");
                exit;
            } else if ($_SESSION['user_role'] == "manager") {
                header("Location: ../../manager/");
                exit;
            }
        } else if ($role == "manager") {
            if (!$_SESSION['signin']) {
                header("Location: ../../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "supplier") {
                header("Location: ../../supplier/");
                exit;
            } else if ($_SESSION['user_role'] == "staff") {
                header("Location: ../../staff/");
                exit;
            }
        } else if ($role == "signin") {
            if (@$_SESSION['user_role'] == "supplier") {
                header("Location: ../../supplier/");
                exit;
            } else if (@$_SESSION['user_role'] == "staff") {
                header("Location: ../../staff/");
                exit;
            } else if (@$_SESSION['user_role'] == "manager") {
                header("Location: ../../manager/");
                exit;
            }
        }
    } else if ($directory == 3) {
        if ($role == "supplier") {
            if (!$_SESSION['signin']) {
                header("Location: ../../../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "staff") {
                header("Location: ../../../staff/");
                exit;
            } else if ($_SESSION['user_role'] == "manager") {
                header("Location: ../../../manager/");
                exit;
            }
        } else if ($role == "staff") {
            if (!$_SESSION['signin']) {
                header("Location: ../../../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "supplier") {
                header("Location: ../../../supplier/");
                exit;
            } else if ($_SESSION['user_role'] == "manager") {
                header("Location: ../../../manager/");
                exit;
            }
        } else if ($role == "manager") {
            if (!$_SESSION['signin']) {
                header("Location: ../../../signin/");
                exit;
            } else if ($_SESSION['user_role'] == "supplier") {
                header("Location: ../../../supplier/");
                exit;
            } else if ($_SESSION['user_role'] == "staff") {
                header("Location: ../../../staff/");
                exit;
            }
        } else if ($role == "signin") {
            if (@$_SESSION['user_role'] == "supplier") {
                header("Location: ../../../supplier/");
                exit;
            } else if (@$_SESSION['user_role'] == "staff") {
                header("Location: ../../../staff/");
                exit;
            } else if (@$_SESSION['user_role'] == "manager") {
                header("Location: ../../../manager/");
                exit;
            }
        }
    }
}